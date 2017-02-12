<?php

namespace app\models;

/**
 * Class User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $status
 * @package app\models
 */
class User extends MainActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_READER = 'reader';
    const STATUS_LIBRARIAN = 'librarian';

    const STATUSES = [self::STATUS_READER, self::STATUS_LIBRARIAN];

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
              [['first_name', 'last_name', 'email'], \yii\validators\RequiredValidator::class],
              [['email'], \yii\validators\UniqueValidator::class],
              [['email'], \yii\validators\EmailValidator::class],
              [['status'], \yii\validators\RangeValidator::class, 'range' => self::STATUSES],
              [['first_name', 'last_name', 'email', 'password'], \yii\validators\StringValidator::class, 'max' => 200],
              [['first_name', 'last_name', 'email', 'password'], \yii\validators\FilterValidator::class, 'filter' => 'trim', 'skipOnArray' => true],
              [['first_name', 'last_name', 'email'], \yii\validators\FilterValidator::class, 'filter' => 'strip_tags', 'skipOnArray' => true],
              [['id', 'first_name', 'last_name', 'email'], \yii\validators\SafeValidator::class],
          ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->getIsNewRecord()) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
                $this->password = \Yii::$app->security->generatePasswordHash($this->password);
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => \Yii::t('app/models/user', 'Id'),
            'first_name' => \Yii::t('app/models/user', 'First name'),
            'last_name'  => \Yii::t('app/models/user', 'Last name'),
            'email'      => \Yii::t('app/models/user', 'Email'),
            'password'   => \Yii::t('app/models/user', 'Password'),
            'auth_key'   => \Yii::t('app/models/user', 'Auth key'),
            'status'     => \Yii::t('app/models/user', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(User::class, ['id' => 'book_id'])->viaTable(BookAtUser::tableName(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Message::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooksAtUser()
    {
        return $this->hasMany(BookAtUser::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActualBooksAtUser()
    {
        return $this->getBooksAtUser()->where(BookAtUser::tableName().'.return_date IS NULL');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOverdueBooksAtUser()
    {
        return $this->getBooksAtUser()->where("'".date('Y-m-d')."' > ".BookAtUser::tableName().".limit_date");
    }

    /**
     * @return bool true if status current user is reader.
     */
    public function isStatusReader()
    {
        return $this->status === self::STATUS_READER;
    }

    /**
     * @return bool true if status current user is librarian.
     */
    public function isStatusLibrarian()
    {
        return $this->status === self::STATUS_LIBRARIAN;
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool true if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
