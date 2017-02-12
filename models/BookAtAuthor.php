<?php

namespace app\models;

/**
 * Class BookAtAuthor
 *
 * @property int $book_id
 * @property int $author_id
 * @package app\models
 */
class BookAtAuthor extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'author_id'], \yii\validators\RequiredValidator::class],
        ];
    }

}
