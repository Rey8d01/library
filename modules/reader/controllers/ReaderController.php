<?php

namespace app\modules\reader\controllers;

use Yii;
use app\controllers\MainController;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class ReaderController extends MainController
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
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Return model {@link \app\models\User} current auth user or throw {@link NotFoundHttpException}.
     *
     * @throws NotFoundHttpException
     * @return \app\models\User
     */
    protected function getModelCurrentUser() {
        $modelUser = Yii::$app->user->getIdentity();
        if (!$modelUser) {
            throw new NotFoundHttpException('You profile not found');
        }
        return $modelUser;
    }
}
