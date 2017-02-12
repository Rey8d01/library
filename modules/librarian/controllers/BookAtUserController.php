<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\BookAtUser;

class BookAtUserController extends LibrarianController
{

    /**
     * List of books at users.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelBookAtUser = new BookAtUser();
        $dataProvider = $modelBookAtUser->search(Yii::$app->request->get());

        return $this->render('index', [
            'modelBookAtUser' => $modelBookAtUser,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * List of not returned books at users.
     *
     * @return string
     */
    public function actionNotReturned()
    {
        $modelBookAtUser = new BookAtUser();
        $dataProvider = $modelBookAtUser->search(Yii::$app->request->get());
        $dataProvider->query->andWhere('return_date IS NULL');

        return $this->render('index', [
            'modelBookAtUser' => $modelBookAtUser,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * List of overdue books at users.
     *
     * @return string
     */
    public function actionOverdue()
    {
        $modelBookAtUser = new BookAtUser();
        $dataProvider = $modelBookAtUser->search(Yii::$app->request->get());
        $dataProvider->query->andWhere("'".date('Y-m-d')."' > limit_date");

        return $this->render('index', [
            'modelBookAtUser' => $modelBookAtUser,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Action new record book at user.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelBookAtUser = new BookAtUser();

        if ($modelBookAtUser->load(Yii::$app->request->post()) && $modelBookAtUser->save()) {
            return $this->redirect(['view', 'id' => $modelBookAtUser->id]);
        }

        $modelBookAtUser->receipt_date = date('Y.m.d');

        return $this->render('create', [
            'modelBookAtUser' => $modelBookAtUser,
        ]);
    }

    /**
     * Action edit info of book at user.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $modelBookAtUser = BookAtUser::findOneOrNotFound($id);

        if ($modelBookAtUser->load(Yii::$app->request->post()) && $modelBookAtUser->save()) {
            return $this->redirect(['view', 'id' => $modelBookAtUser->id]);
        }

        return $this->render('update', [
            'modelBookAtUser' => $modelBookAtUser,
        ]);
    }

    /**
     * Action return book from user to library.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionReturn($id)
    {
        $modelBookAtUser = BookAtUser::findOneOrNotFound($id);

        $modelBookAtUser->return_date = date('Y.m.d');

        if ($modelBookAtUser->save()) {
            return $this->redirect(['view', 'id' => $modelBookAtUser->id]);
        }

        return $this->render('update', [
            'modelBookAtUser' => $modelBookAtUser,
        ]);
    }

    /**
     * View detail book at user.
     *
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        $modelBookAtUser = BookAtUser::findOneOrNotFound($id);

        return $this->render('view', [
            'modelBookAtUser' => $modelBookAtUser,
        ]);
    }

    /**
     * Delete record of book at user.
     *
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $modelBookAtUser = BookAtUser::findOneOrNotFound($id);

        if ($modelBookAtUser->delete()) {
            return $this->redirect(['index']);
        }
        return $this->refresh();
    }
}
