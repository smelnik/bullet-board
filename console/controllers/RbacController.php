<?php

namespace console\controllers;

use common\models\User;
use common\rbac\AuthorRule;
use Yii;
use yii\base\Exception;
use yii\console\Controller;

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

        // create permission and rule to allow an author to update own posts
        $rule = new AuthorRule();
        $auth->add($rule);
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);
        $auth->addChild($updateOwnPost, $updatePost);
        $auth->addChild($author, $updateOwnPost);

        $adminUser = User::findOne(1);
        if (!empty($adminUser)) {
            $auth->assign($admin, $adminUser->id);
        }
    }
}
