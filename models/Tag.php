<?php

namespace app\models;

/**
 * Class Tag
 *
 * @property int $id
 * @property string $title
 * @property string $alias
 * @package app\models
 */
class Tag extends MainActiveRecord
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
            [['title', 'alias'], \yii\validators\StringValidator::class, 'max' => 255],
            [['title', 'alias'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['title', 'alias'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
            [['id', 'title', 'alias'], \yii\validators\SafeValidator::class],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app/models/tag', 'Id'),
            'title' => \Yii::t('app/models/tag', 'Title'),
            'alias' => \Yii::t('app/models/tag', 'Alias'),
        ];
    }
}
