<?php

namespace frontend\repositories;

use common\models\UserInfo;
use yii\base\BaseObject;

class UserInfoRepository extends BaseObject
{
    /**
     * @param int $uid
     * @return UserInfo|null
     */
    public function createUserInfoForUserId(int $uid): ?UserInfo
    {
        // create user info record
        $userInfo = new UserInfo();
        $userInfo->user_id = $uid;

        if (!$userInfo->save()) {
            return null;
        }

        return $userInfo;
    }
}