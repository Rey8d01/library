<?php

namespace app\models\forms;

use yii\base\Model;
use app\models\User;

/**
 * RegistrationForm.
 */
class RegistrationForm extends Model
{
    /**
     * @var string
     */
    public $firstName;
    /**
     * @var string
     */
    public $lastName;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'email', 'password'], \yii\validators\RequiredValidator::class],
            [['email'], \yii\validators\EmailValidator::class],
            [['email'], \yii\validators\UniqueValidator::class, 'targetClass' => User::class, 'targetAttribute' => 'email'],
            [['firstName', 'lastName', 'email', 'password'], \yii\validators\StringValidator::class, 'max' => 200],
            [['firstName', 'lastName', 'email', 'password'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
            [['firstName', 'lastName', 'email'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'firstName' => \Yii::t('app/models/user', 'First name'),
            'lastName'  => \Yii::t('app/models/user', 'Last name'),
            'email'      => \Yii::t('app/models/user', 'Email'),
            'password'   => \Yii::t('app/models/user', 'Password'),
        ];
    }

    /**
     * Register new user.
     *
     * @return bool
     */
    public function registration()
    {
        if(!$this->validate()) {
            return false;
        }

        $modelUser = User::findByEmail($this->email);
        if($modelUser) {
            return false;
        }

        $modelUser = new User();
        $modelUser->setAttributes([
            'first_name' => $this->firstName,
            'last_name'  => $this->lastName,
            'email'      => $this->email,
            'password'   => $this->password,
        ]);

        $result = $modelUser->save();

        return $result;
    }

}
