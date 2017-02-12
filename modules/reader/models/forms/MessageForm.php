<?php

namespace app\modules\reader\models\forms;

use yii\base\Model;
use app\models\Message;

/**
 * MessageForm.
 */
class MessageForm extends Model
{
    /**
     * @var string
     */
    public $textMessage;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['textMessage'], \yii\validators\RequiredValidator::class],
            [['textMessage'], \yii\validators\StringValidator::class, 'max' => 2000],
            [['textMessage'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['textMessage'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'textMessage' => \Yii::t('app/models/message', 'Text message'),
        ];
    }

    /**
     * @param \app\models\User $modelUser
     * @return bool true if message sended success.
     */
    public function sendFromUser(\app\models\User $modelUser)
    {
        $modelMessage = new Message();
        $modelMessage->text_message = $this->textMessage;
        $modelMessage->user_id = $modelUser->id;

        return $modelMessage->save();
    }
}
