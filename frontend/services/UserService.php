<?php

namespace frontend\services;

use common\models\User;
use common\models\UserInfo;
use frontend\repositories\UserInfoRepository;
use frontend\repositories\UserRepository;
use Yii;
use yii\base\BaseObject;
use yii\web\UploadedFile;

class UserService extends BaseObject
{
    /**
     * @var UploadedFileService
     */
    public $uploadedFileService;

    /**
     * @var UserRepository
     */
    public $userRepository;

    /**
     * @var UserInfoRepository
     */
    public $userInfoRepository;

    /**
     * UserService constructor.
     * @param UploadedFileService $uploadedFileService
     * @param UserRepository $userRepository
     * @param UserInfoRepository $userInfoRepository
     * @param array $config
     */
    public function __construct(
        UploadedFileService $uploadedFileService,
        UserRepository $userRepository,
        UserInfoRepository $userInfoRepository,
        array $config = []
    ) {
        $this->uploadedFileService = $uploadedFileService;
        $this->userRepository = $userRepository;
        $this->userInfoRepository = $userInfoRepository;

        parent::__construct($config);
    }

    /**
     * @param int $uid
     * @return bool
     */
    public function isOwnerOfUserId(int $uid)
    {
        return !Yii::$app->user->isGuest && (Yii::$app->user->identity->getId() === $uid);
    }

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
        $user = $this->userRepository->createUser($username, $email, $password);

        if (!$user) {
            Yii::warning('Can\'t create User');
        }

        return $user;
    }

    /**
     * @param int $uid
     * @return UserInfo|null
     */
    public function createUserInfoForUserId(int $uid): ?UserInfo
    {
        $userInfo = $this->userInfoRepository->createUserInfoForUserId($uid);

        if (!$userInfo) {
            Yii::warning('Can\'t create UserInfo for User with ID = ' . $uid);
        }

        return $userInfo;
    }

    /**
     * @param UserInfo $userInfo
     * @param array $data
     * @return bool
     */
    public function updateUserInfo(UserInfo $userInfo, array $data): bool
    {
        $oldFileName = $userInfo->avatar_url;

        if (!$userInfo->load($data)) {
            return false;
        }

        $uploadedFile = UploadedFile::getInstance($userInfo, 'avatar_url');
        $savedUploadedFile = $this->uploadedFileService->saveUserPicture($uploadedFile, $userInfo->user_id);

        if ($savedUploadedFile === false) {
            $userInfo->avatar_url = $oldFileName;
        } else {
            $userInfo->avatar_url = $savedUploadedFile;
            $this->uploadedFileService->removeUserPicture($oldFileName, $userInfo->user_id);
        }

        if (!$userInfo->save()) {
            return false;
        }

        return true;
    }

    /**
     * Get User by user identifier
     * @param int $uid
     * @return User|null
     */
    public function getUserById(int $uid): ?User
    {
        return $this->userRepository->getActiveUserById($uid);
    }

    /**
     * @param int $uid
     * @return UserInfo|null
     */
    public function getUserInfoByUserId(int $uid): ?UserInfo
    {
        $user = $this->getUserById($uid);

        if (!$user) {
            Yii::warning('User with ID = ' . $uid . ' not found');
            return null;
        }

        $userInfo = $user->userInfo;

        if (!$userInfo) {
            Yii::warning('UserInfo for User with ID = ' . $uid
                . ' not found. Try create new UserInfo.');
            $userInfo = $this->createUserInfoForUserId($user->id);
        }

        return $userInfo;
    }
}