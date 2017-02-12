<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\User;

class UserController extends LibrarianController
{

    /**
     * List of users.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelUser = new User();
        $dataProvider = $modelUser->search(Yii::$app->request->get());

        return $this->render('index', [
            'modelUser' => $modelUser,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * List of debtors users.
     *
     * @return string
     */
    public function actionDebtors()
    {
        $modelUser = new User();
        $dataProvider = $modelUser->search(Yii::$app->request->get());
        $dataProvider->query->joinWith('overdueBooksAtUser', true, 'INNER JOIN');

        return $this->render('index', [
            'modelUser' => $modelUser,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Action edit info of user.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $modelUser = User::findOneOrNotFound($id);

        if ($modelUser->load(Yii::$app->request->post()) && $modelUser->save()) {
            return $this->redirect(['view', 'id' => $modelUser->id]);
        }

        return $this->render('update', [
            'modelUser' => $modelUser,
        ]);
    }

    /**
     * View detail user.
     *
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        $modelUser = User::findOneOrNotFound($id);
        $dataProviderBookAtUserActual = new \yii\data\ActiveDataProvider(['query' => $modelUser->getActualBooksAtUser()]);
        $dataProviderBookAtUserOverdue = new \yii\data\ActiveDataProvider(['query' => $modelUser->getOverdueBooksAtUser()]);
        $dataProviderMessage = new \yii\data\ActiveDataProvider(['query' => $modelUser->getMessages()]);

        return $this->render('view', [
            'modelUser' => $modelUser,
            'dataProviderBookAtUserActual' => $dataProviderBookAtUserActual,
            'dataProviderBookAtUserOverdue' => $dataProviderBookAtUserOverdue,
            'dataProviderMessage' => $dataProviderMessage,
        ]);
    }

}
