<?php

namespace console\controllers;

use common\models\User;
use Yii;
use yii\base\Exception;
use yii\console\Controller;
use yii\rbac\Permission;

/**
 * Class RbacController
 * @package console\controllers
 */
class RbacController extends Controller
{
    /**
     * @throws Exception
     * @throws \Exception
     */
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);

        $author = $auth->createRole('author');
        $auth->add($author);
        $auth->addChild($author, $createPost);

        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $author);

        $adminUser = User::findOne(1);
        if (empty($adminUser)) {
            echo 'Notice: User with ID = 1 not found. Please registry first user.' . PHP_EOL;
        } else {
            $auth->assign($admin, $adminUser->id);
        }

        $authorUser = User::findOne(2);
        if (empty($authorUser)) {
            echo 'Notice: User with ID = 2 not found. Please registry yet another user.' . PHP_EOL;
        } else {
            $auth->assign($author, $authorUser->id);
        }
    }
}
