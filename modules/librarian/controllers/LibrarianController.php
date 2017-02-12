<?php

namespace app\modules\librarian\controllers;

use app\controllers\MainController;
use yii\filters\AccessControl;

class LibrarianController extends MainController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'matchCallback' => function () {
                            return \Yii::$app->user->getIsLibrarian();
                        },
                    ],
                ],
            ],
        ];
    }
}
