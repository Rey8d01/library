<?php

namespace app\components;

/**
 * Class User.
 *
 * @method app\models\User getIdentity()
 */
class User extends \yii\web\User
{

    /**
     * @return bool true if user is reader.
     */
    public function getIsReader()
    {
        return !$this->getIsGuest() && $this->getIdentity()->isStatusReader();
    }

    /**
     * @return bool true if user is librarian.
     */
    public function getIsLibrarian()
    {
        return !$this->getIsGuest() && $this->getIdentity()->isStatusLibrarian();
    }

    /**
     * @return bool true if user is librarian or reader.
     */
    public function getIsLibrarianOrReader()
    {
        return $this->getIsReader() || $this->getIsLibrarian();
    }
}
