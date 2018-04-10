<?php

namespace frontend\repositories;

use common\models\User;
use yii\base\BaseObject;

class UserRepository extends BaseObject
{
    /**
     * @param string $username
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function createUser(
        string $username,
        string $email,
        string $password
    ): ?User {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        if (!$user->save()) {
            return null;
        }

        return $user;
    }

    /**
     * @param $uid
     * @return User|null
     */
    public function getActiveUserById($uid): ?User
    {
        return User::findOne([
            'id' => $uid,
            'status' => User::STATUS_ACTIVE,
        ]);
    }
}
