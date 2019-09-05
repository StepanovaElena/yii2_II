<?php
namespace console\controllers;

use yii\console\Controller;
use yii\rbac\ManagerInterface;


class RbacController extends Controller
{
    public function getAuthManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function actionInit()
    {
        $auth = $this->getAuthManager();

        // добавляем разрешение "createTask"
        $createTask = $auth->createPermission('createTask');
        $createTask->description = 'Создание задачи';
        $auth->add($createTask);

        // добавляем разрешение "editTask"
        $editTask = $auth->createPermission('editTask');
        $editTask->description = 'Редактирование задачи';
        $auth->add($editTask);

        // добавляем разрешение "blockTask"
        $blockTask = $auth->createPermission('blockTask');
        $blockTask->description = 'Блокирование задачи';
        $auth->add($blockTask);

        // добавляем разрешение "createUser"
        $createUser = $auth->createPermission('createUser');
        $createUser->description = 'Создание пользователя';
        $auth->add($createUser);

        // добавляем разрешение "editUser"
        $editUser = $auth->createPermission('editUser');
        $editUser->description = 'Редактирование пользователя';
        $auth->add($editUser);

        // добавляем роль "user"
        $user = $auth->createRole('user');
        $user->description = 'Роль пользователя';
        $auth->add($user);
        $auth->addChild($user, $createTask);
        $auth->addChild($user, $editTask);

        // добавляем роль "admin"
        // а также все разрешения роли "user"
        $admin = $auth->createRole('admin');
        $admin->description = 'Роль администратора';
        $auth->add($admin);
        $auth->addChild($admin, $blockTask);
        $auth->addChild($admin, $createUser);
        $auth->addChild($admin, $editUser);
        $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        $auth->assign($user, 2);
        $auth->assign($admin, 1);
    }
}