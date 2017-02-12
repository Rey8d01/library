<?php

namespace app\controllers;

use Yii;
use app\models\Book;

class CatalogController extends MainController
{

    /**
     * List of books.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelBook = new Book();
        $dataProvider = $modelBook->search(Yii::$app->request->get());

        $authorIds = Yii::$app->request->get('authors', []);
        $tagIds = Yii::$app->request->get('tags', []);

        Book::applyFilterForRelatedData($dataProvider->query, $tagIds, $authorIds);

        return $this->render('index', [
            'modelBook' => $modelBook,
            'dataProvider' => $dataProvider,
            'authorIds' => $authorIds,
            'tagIds' => $tagIds,
        ]);
    }

    /**
     * View detail of book by its alias.
     *
     * @param string $alias
     * @return string
     */
    public function actionView($alias)
    {
        $modelBook = Book::findOne(['alias' => $alias]);

        return $this->render('view', [
            'modelBook' => $modelBook,
        ]);
    }
}
