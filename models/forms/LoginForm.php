<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm.
 */
class LoginForm extends Model
{
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var bool
     */
    public $rememberMe = true;
    /**
     * @var User|null
     */
    private $_modelUser = null;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email', 'password'], \yii\validators\RequiredValidator::class],
            [['email'], \yii\validators\EmailValidator::class],
            [['email'], \yii\validators\StringValidator::class, 'max' => 200],
            [['rememberMe'], \yii\validators\BooleanValidator::class],
            [['password'], 'validatePassword'],
            [['email', 'password'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['email', 'password'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rememberMe' => \Yii::t('app/library', 'Remember me'),
            'email'      => \Yii::t('app/models/user', 'Email'),
            'password'   => \Yii::t('app/models/user', 'Password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $modelUser = $this->getModelUser();

            if (!$modelUser || !$modelUser->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getModelUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getModelUser()
    {
        if (!$this->_modelUser) {
            $this->_modelUser = User::findByEmail($this->email);
        }
        return $this->_modelUser;
    }
}
