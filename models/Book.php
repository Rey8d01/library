<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * Class Book
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @property string $photo
 * @property string $description
 * @property int $copies
 * @package app\models
 */
class Book extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'alias'], \yii\validators\RequiredValidator::class],
            [['alias'], \yii\validators\UniqueValidator::class],
            [['alias'], \yii\validators\RegularExpressionValidator::class, 'pattern' => '/^[\w-]+$/'],
            [['photo', 'title', 'alias'], \yii\validators\StringValidator::class, 'max' => 255],
            [['description'], \yii\validators\StringValidator::class, 'max' => 2000],
            [['copies'], \yii\validators\NumberValidator::class, 'integerOnly' => true],
            [['photo', 'title', 'alias', 'description'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['photo', 'title', 'alias', 'description'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
            [['id', 'photo', 'title', 'alias', 'description', 'copies'], \yii\validators\SafeValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app/models/book', 'Id'),
            'title' => \Yii::t('app/models/book', 'Title'),
            'alias' => \Yii::t('app/models/book', 'Alias'),
            'photo' => \Yii::t('app/models/book', 'Photo'),
            'description' => \Yii::t('app/models/book', 'Description'),
            'copies' => \Yii::t('app/models/book', 'Copies'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthors()
    {
        return $this->hasMany(Author::class, ['id' => 'author_id'])->viaTable(BookAtAuthor::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])->viaTable(BookAtTag::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable(BookAtUser::tableName(), ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookAtUsers()
    {
        return $this->hasMany(BookAtUser::class, ['book_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActualBookAtUsers()
    {
        return $this->getBookAtUsers()->where('return_date IS NULL');
    }

    /**
     * @return int Count this book at users.
     */
    public function getCountAllHolders()
    {
        return $this->getBookAtUsers()->count();
    }

    /**
     * @return int Count this book at users.
     */
    public function getCountCurrentHolders()
    {
        return $this->getActualBookAtUsers()->count();
    }

    /**
     * @return bool - true if this book possible receive to user.
     */
    public function isPossibleReceive()
    {
        return $this->getCountCurrentHolders() < intval($this->copies);
    }

    /**
     * Применение фильтров по связанным данным модели.
     *
     * Поскольку модель имеет 2 связи многие ко многим - необходимо иметь возможность осуществлять строгую
     * фильтрацию по обеим связям. На чистом AR это сделать проблематично, в силу этого часть запроса
     * сформирована вручную.
     *
     * @param ActiveQuery $query
     * @param array $tagIds
     * @param array $authorIds
     */
    public static function applyFilterForRelatedData(ActiveQuery $query, array $tagIds = [], array $authorIds = [])
    {
        if ($tagIds && $authorIds) {
            // Строгая фильтрация по обеим полям
            // Произведение фильтруемого количества меток на количество авторов - даст требуемое значение
            // для фильтрации по обеим критериям
            $cnt = count($tagIds) * count($authorIds);

            $query
                ->addSelect([
                    Book::tableName().'.*',
                    'COUNT(book_at_tag.book_id) AS cntTag',
                    'COUNT(book_at_author.book_id) AS cntAuthor',
                ])
                ->leftJoin('book_at_tag', '`book`.`id` = `book_at_tag`.`book_id`')
                ->leftJoin('book_at_author', '`book`.`id` = `book_at_author`.`book_id` ')
                ->andFilterWhere([
                    'tag_id' => array_values($tagIds),
                    'author_id' => array_values($authorIds),
                ])
                ->groupBy([
                    'book_at_tag.book_id',
                    'book_at_author.book_id',
                ])
                ->having('cntTag = '.$cnt)
                ->andHaving('cntAuthor = '.$cnt);
        } elseif ($tagIds || $authorIds) {
            if ($tagIds) {
                // Применение фильтра по наличию всех меток в $tagIds для объекта $query.
                $nameRelation = 'tags';
                $nameFieldRelation = 'tag_id';
                $list = $tagIds;
            } else {
                // Применение фильтра по наличию всех авторов в $authorIds для объекта $query.
                $nameRelation = 'authors';
                $nameFieldRelation = 'author_id';
                $list = $authorIds;
            }

            $query
                ->addSelect([Book::tableName().'.*', 'COUNT('.Book::tableName().'.id) AS cnt'])
                ->joinWith($nameRelation)
                ->andFilterWhere([$nameFieldRelation => array_values($list)])
                ->groupBy('book_id')
                ->having('cnt = '.count($list));
        }
    }

    /**
     * Apply condition for {@link ActiveQuery} by available books for getting by users.
     *
     * Analog query:
     * SELECT b.id, b.alias, b.copies FROM book b
     * LEFT JOIN (SELECT book_id, count(*) cnt FROM book_at_user bu WHERE return_date IS NULL group by book_id) t ON t.book_id=b.id
     * WHERE b.copies > IFNULL(t.cnt, 0)
     *
     * @param ActiveQuery $query
     */
    public static function applyFilterAvailableBooks(ActiveQuery $query)
    {
        $query
          ->addSelect([
              Book::tableName().'.*',
              'COUNT('.BookAtUser::tableName().'.`book_id`) AS cnt',
          ])
          ->leftJoin(BookAtUser::tableName(), Book::tableName().'.`id` = '.BookAtUser::tableName().'.`book_id` AND '.BookAtUser::tableName().'.`return_date` IS NULL')
          ->groupBy([
              Book::tableName().'.`id`',
          ])
          ->having('cnt < '.Book::tableName().'.`copies`');
    }
}
