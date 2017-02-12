<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\Author;

class AuthorController extends LibrarianController
{

    /**
     * List authors of books.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelAuthor = new Author();
        $dataProvider = $modelAuthor->search(Yii::$app->request->get());

        return $this->render('index', [
            'modelAuthor' => $modelAuthor,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Action new author.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelAuthor = new Author();

        if ($modelAuthor->load(Yii::$app->request->post()) && $modelAuthor->save()) {
            return $this->redirect(['author/view', 'id' => $modelAuthor->id]);
        }

        return $this->render('create', [
            'modelAuthor' => $modelAuthor,
        ]);
    }

    /**
     * Action edit info of author.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $modelAuthor = Author::findOneOrNotFound($id);

        if ($modelAuthor->load(Yii::$app->request->post()) && $modelAuthor->save()) {
            return $this->redirect(['author/view', 'id' => $modelAuthor->id]);
        }

        return $this->render('update', [
            'modelAuthor' => $modelAuthor,
        ]);
    }

    /**
     * View detail author.
     *
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        $modelAuthor = Author::findOneOrNotFound($id);

        return $this->render('view', [
            'modelAuthor' => $modelAuthor,
        ]);
    }

    /**
     * Action delete author.
     *
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $modelAuthor = Author::findOneOrNotFound($id);

        if ($modelAuthor->delete()) {
            return $this->redirect(['index']);
        }
        return $this->refresh();
    }

}
