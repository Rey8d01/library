<?php

namespace app\models;

/**
 * Class Message
 *
 * @property int $id
 * @property int $user_id
 * @property string $text_message
 * @property string $create_time
 * @package app\models
 */
class Message extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'text_message'], \yii\validators\RequiredValidator::class],
            [['text_message'], \yii\validators\StringValidator::class, 'max' => 2000],
            [['text_message'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['text_message'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
            [['id', 'user_id', 'text_message', 'create_time'], \yii\validators\SafeValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => \Yii::t('app/models/message', 'Id'),
            'user_id'      => \Yii::t('app/models/message', 'User'),
            'text_message' => \Yii::t('app/models/message', 'Text message'),
            'create_time'  => \Yii::t('app/models/message', 'Create time'),
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
    public function getOverdueBookAtUser()
    {
        return $this->hasMany(BookAtUser::class, ['user_id' => 'id'])
          ->viaTable(User::tableName(), ['id' => 'user_id'])
          ->where("'".date('Y-m-d')."' > ".BookAtUser::tableName().".limit_date");
    }
}
