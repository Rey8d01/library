<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\forms\LoginForm;
use app\models\forms\RegistrationForm;

class AuthController extends MainController
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'registration'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login', 'registration'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Registration new user.
     *
     * @return string
     */
    public function actionRegistration()
    {
        $modelRegistrationForm = new RegistrationForm();
        if ($modelRegistrationForm->load(Yii::$app->request->post()) && $modelRegistrationForm->validate() && $modelRegistrationForm->registration()) {
            return $this->goBack();
        }
        return $this->render('registration', [
            'modelRegistrationForm' => $modelRegistrationForm,
        ]);
    }

    /**
     * Login user.
     *
     * @return string
     */
    public function actionLogin()
    {
        $modelLoginForm = new LoginForm();
        if ($modelLoginForm->load(Yii::$app->request->post()) && $modelLoginForm->login()) {
            return $this->goHome();
        }
        return $this->render('login', [
            'modelLoginForm' => $modelLoginForm,
        ]);
    }

    /**
     * Logout user.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack();
    }

}
