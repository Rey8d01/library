<?php

namespace app\models;

/**
 * Class BookAtTag
 *
 * @property int $book_id
 * @property int $tag_id
 * @package app\models
 */
class BookAtTag extends MainActiveRecord
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['book_id', 'tag_id'], \yii\validators\RequiredValidator::class],
        ];
    }

}
