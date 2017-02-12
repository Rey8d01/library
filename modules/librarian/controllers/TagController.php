<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\Tag;

class TagController extends LibrarianController
{

    /**
     * List of tags.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelTag = new Tag();
        $dataProvider = $modelTag->search(Yii::$app->request->get());

        return $this->render('index', [
            'modelTag' => $modelTag,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Action new tag.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelTag = new Tag();

        if ($modelTag->load(Yii::$app->request->post()) && $modelTag->save()) {
            return $this->redirect(['view', 'id' => $modelTag->id]);
        }

        return $this->render('create', [
            'modelTag' => $modelTag,
        ]);
    }

    /**
     * Action edit info of tag.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $modelTag = Tag::findOneOrNotFound($id);

        if ($modelTag->load(Yii::$app->request->post()) && $modelTag->save()) {
            return $this->redirect(['view', 'id' => $modelTag->id]);
        }

        return $this->render('update', [
            'modelTag' => $modelTag,
        ]);
    }

    /**
     * View detail tag.
     *
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        $modelTag = Tag::findOneOrNotFound($id);

        return $this->render('view', [
            'modelTag' => $modelTag,
        ]);
    }

    /**
     * Action delete tag.
     *
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $modelTag = Tag::findOneOrNotFound($id);

        if ($modelTag->delete()) {
            return $this->redirect(['index']);
        }
        return $this->refresh();
    }

}
