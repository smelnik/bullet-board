<?php
namespace frontend\models;

use frontend\services\UserService;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(
        UserService $userService,
        array $config = []
    ) {
        $this->userService = $userService;
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     * @throws \Exception
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->userService->createUser(
            $this->username,
            $this->email,
            $this->password
        );

        if (!$user) {
            return null;
        }

        $userInfo = $this->userService->createUserInfoForUserId($user->id);

        if (!$userInfo) {
            return null;
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($user->id === 1 ? 'admin' : 'author');
        $auth->assign($role, $user->id);

        return $user;
    }
}
