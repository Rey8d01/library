<?php

namespace app\modules\reader\controllers;

use Yii;

class UserController extends ReaderController
{

    /**
     * Главная страница админки.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelUser = $this->getModelCurrentUser();
        $dataProviderBookAtUserActual = new \yii\data\ActiveDataProvider(['query' => $modelUser->getActualBooksAtUser()]);
        $dataProviderBookAtUserOverdue = new \yii\data\ActiveDataProvider(['query' => $modelUser->getOverdueBooksAtUser()]);

        return $this->render('index', [
            'modelUser' => $modelUser,
            'dataProviderBookAtUserActual' => $dataProviderBookAtUserActual,
            'dataProviderBookAtUserOverdue' => $dataProviderBookAtUserOverdue,
        ]);
    }

    /**
     * Страница изменения метки.
     *
     * @return string|\yii\web\Response
     */
    public function actionUpdate()
    {
        $modelUser = $this->getModelCurrentUser();
        if ($modelUser->load(Yii::$app->request->post()) && $modelUser->save()) {
            return $this->redirect('index');
        }

        return $this->render('update', [
            'modelUser' => $modelUser,
        ]);
    }
}
