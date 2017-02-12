<?php

namespace app\modules\reader\controllers;

use Yii;
use app\modules\reader\models\forms\MessageForm;
use app\models\Message;
use yii\data\ActiveDataProvider;

class MessageController extends ReaderController
{

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelUser = $this->getModelCurrentUser();
        $queryMessage = Message::find();
        $dataProviderMessage = new ActiveDataProvider([
            'query' => Message::find()->where(['user_id' => $modelUser->id]),
        ]);

        return $this->render('index', [
            'modelUser' => $modelUser,
            'dataProviderMessage' => $dataProviderMessage,
        ]);
    }

    /**
     * Action write new message to librarian.
     *
     * @return string
     */
    public function actionNewMessage()
    {
        $modelUser = $this->getModelCurrentUser();
        $modelMessageForm = new MessageForm();

        if ($modelMessageForm->load(Yii::$app->request->post()) && $modelMessageForm->sendFromUser($modelUser)) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->redirect('index');
        }

        return $this->render('newMessage', [
            'modelUser' => $modelUser,
            'modelMessageForm' => $modelMessageForm,
        ]);
    }

}
