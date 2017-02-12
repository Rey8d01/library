<?php

namespace app\models;

/**
 * Class BookAtUser
 *
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property string $limit_date
 * @property string $return_date
 * @property string $receipt_date
 * @package app\models
 */
class BookAtUser extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id'], \yii\validators\RequiredValidator::class],
            [['user_id'], \yii\validators\ExistValidator::class, 'targetClass' => User::class, 'targetAttribute' => 'id'],
            [['book_id'], \yii\validators\ExistValidator::class, 'targetClass' => Book::class, 'targetAttribute' => 'id'],
            [['book_id'], 'validatePossibleReceive'],
            [['book_id', 'user_id'], \yii\validators\NumberValidator::class, 'integerOnly' => true],
            [['id', 'book_id', 'user_id', 'limit_date', 'return_date', 'receipt_date'], \yii\validators\SafeValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app/models/bookAtUser', 'Id'),
            'book_id' => \Yii::t('app/models/bookAtUser', 'Book'),
            'user_id' => \Yii::t('app/models/bookAtUser', 'Reader'),
            'limit_date' => \Yii::t('app/models/bookAtUser', 'Limit date'),
            'return_date' => \Yii::t('app/models/bookAtUser', 'Return date'),
            'receipt_date' => \Yii::t('app/models/bookAtUser', 'Receipt date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    /**
     * @param string $attribute
     * @param array $params
     */
    public function validatePossibleReceive($attribute, $params) {
      if ($this->getIsNewRecord() && !$this->book->isPossibleReceive()) {
          $this->addError($attribute, \Yii::t('app/models/bookAtUser', 'Copies of the book is not enough'));
      }
    }
}
