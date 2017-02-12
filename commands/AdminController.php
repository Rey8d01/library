<?php

namespace app\commands;

use yii\console\Controller;
use app\models\User;

/**
 * Class AdminController.
 */
class AdminController extends Controller
{

    /**
     * Set status {@link User::STATUS_LIBRARIAN} for user.
     *
     * @param int $userId
     */
    public function actionSetStatusLibrarianByUserId($userId)
    {
        $modelUser = User::findOneOrNotFound(intval($userId));
        $modelUser->setAttribute('status', User::STATUS_LIBRARIAN);
        $modelUser->save();
        echo "Now user #{$modelUser->id} have status {$modelUser->status} \n";
    }

    /**
     * Set status {@link User::STATUS_READER} for user.
     *
     * @param int $userId
     */
    public function actionSetStatusReaderByUserId($userId)
    {
        $modelUser = User::findOneOrNotFound(intval($userId));
        $modelUser->setAttribute('status', User::STATUS_READER);
        $modelUser->save();
        echo "Now user #{$modelUser->id} have status {$modelUser->status} \n";
    }

}
