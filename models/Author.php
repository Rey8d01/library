<?php

namespace app\models;

/**
 * Class Author
 *
 * @property int $id
 * @property string $name
 * @property string $photo
 * @property string $description
 * @package app\models
 */
class Author extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], \yii\validators\RequiredValidator::class],
            [['photo', 'name'], \yii\validators\StringValidator::class, 'max' => 255],
            [['description'], \yii\validators\StringValidator::class, 'max' => 2000],
            [['photo', 'name', 'description'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['photo', 'name', 'description'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],

            [['id', 'photo', 'name', 'description'], \yii\validators\SafeValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app/models/author', 'Id'),
            'name' => \Yii::t('app/models/author', 'Name'),
            'description' => \Yii::t('app/models/author', 'Description'),
            'photo' => \Yii::t('app/models/author', 'Photo'),
        ];
    }
}
