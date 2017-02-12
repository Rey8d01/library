<?php

namespace app\modules\librarian\controllers;

use Yii;
use app\models\Book;
use app\models\Author;
use app\models\Tag;

class BookController extends LibrarianController
{

    /**
     * List of books.
     *
     * @return string
     */
    public function actionIndex()
    {
        $modelBook = new Book();
        $dataProviderBook = $modelBook->search(Yii::$app->request->get());

        return $this->render('index', [
            'modelBook' => $modelBook,
            'dataProviderBook' => $dataProviderBook,
        ]);
    }

    /**
     * List of available books.
     *
     * @return string
     */
    public function actionListAvailableBooks()
    {
        $modelBook = new Book();
        $dataProviderBook = $modelBook->search(Yii::$app->request->get());
        Book::applyFilterAvailableBooks($dataProviderBook->query);

        return $this->render('index', [
            'modelBook' => $modelBook,
            'dataProviderBook' => $dataProviderBook,
        ]);
    }

    /**
     * Action new book.
     *
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelBook = new Book();

        $this->_saveBook($modelBook);

        return $this->render('create', [
            'modelBook' => $modelBook,
        ]);
    }

    /**
     * Action edit info of book.
     *
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate($id)
    {
        $modelBook = Book::findOneOrNotFound($id);

        $this->_saveBook($modelBook);

        return $this->render('update', [
            'modelBook' => $modelBook,
        ]);
    }

    /**
     * View detail book.
     *
     * @param int $id
     * @return string
     */
    public function actionView($id)
    {
        $modelBook = Book::findOneOrNotFound($id);

        $dataProviderAuthor = new \yii\data\ActiveDataProvider(['query' => $modelBook->getAuthors()]);
        $dataProviderTag = new \yii\data\ActiveDataProvider(['query' => $modelBook->getTags()]);
        $dataProviderBookAtUser = new \yii\data\ActiveDataProvider(['query' => $modelBook->getBookAtUsers()]);

        return $this->render('view', [
            'modelBook' => $modelBook,
            'dataProviderAuthor' => $dataProviderAuthor,
            'dataProviderTag' => $dataProviderTag,
            'dataProviderBookAtUser' => $dataProviderBookAtUser,
        ]);
    }

    /**
     * Action delete book.
     *
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $modelBook = Book::findOneOrNotFound($id);

        if ($modelBook->delete()) {
            return $this->redirect(['index']);
        }
        return $this->refresh();
    }

    /**
     * Save the model and all related data ({@link Author} and {@link Tag}) for it.
     *
     * @param Book $modelBook
     * @return \yii\web\Response
     */
    private function _saveBook(Book $modelBook)
    {
        $authorIds = Yii::$app->request->post('authors');
        $tagIds = Yii::$app->request->post('tags');

        if ($modelBook->load(Yii::$app->request->post()) && $modelBook->save()) {
            array_map(function (Author $modelAuthor) use ($modelBook) {
                $modelBook->unlink('authors', $modelAuthor, true);
            }, $modelBook->authors);
            foreach ($authorIds?:[] as $authorId) {
                $modelAuthor = Author::findOne($authorId);
                $modelBook->link('authors', $modelAuthor);
            }

            array_map(function (Tag $modelTag) use ($modelBook) {
                $modelBook->unlink('tags', $modelTag, true);
            }, $modelBook->tags);
            foreach ($tagIds?:[] as $tagId) {
                $modelTag = Tag::findOne($tagId);
                $modelBook->link('tags', $modelTag);
            }

            return $this->redirect(['view', 'id' => $modelBook->id]);
        }
    }
}
