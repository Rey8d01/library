<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\Message;

class MessageController extends LibrarianController
{

    /**
     * List of messages.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelMessage = new Message();
        $dataProviderMessage = $modelMessage->search(Yii::$app->request->get());
        $dataProviderMessage->query->orderBy(Message::tableName().'.id DESC');

        return $this->render('index', [
            'modelMessage' => $modelMessage,
            'dataProviderMessage' => $dataProviderMessage,
        ]);
    }

    /**
     * List of messages from debtors.
     *
     * @return string
     */
    public function actionFromDebtors()
    {
        $modelMessage = new Message();
        $dataProviderMessage = $modelMessage->search(Yii::$app->request->get());
        $dataProviderMessage->query->joinWith('overdueBookAtUser', true, 'INNER JOIN')->orderBy(Message::tableName().'.id DESC');

        return $this->render('index', [
            'modelMessage' => $modelMessage,
            'dataProviderMessage' => $dataProviderMessage,
        ]);
    }
}
