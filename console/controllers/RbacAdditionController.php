<?php
namespace console\controllers;

use common\rules\ManagerProjectRule;
use common\rules\OwnerProjectRule;
use common\rules\OwnerTaskRule;
use yii\console\Controller;
use yii\rbac\ManagerInterface;


class RbacAdditionController extends Controller
{
    public function getAuthManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function actionInit()
    {
        $auth = $this->getAuthManager();

        // добавляем разрешение "createProject"
        $createProject = $auth->createPermission('createProject');
        $createProject->description = 'Создание проекта';
        $auth->add($createProject);

        // добавляем разрешение "editProject"
        $editProject = $auth->createPermission('editProject');
        $editProject->description = 'Редактирование проекта';
        $auth->add($editProject);

        // добавляем разрешение "blockProject"
        $blockProject = $auth->createPermission('blockProject');
        $blockProject->description = 'Блокирование проекта';
        $auth->add($blockProject);

        // добавляем разрешение "deleteProject"
        $deleteProject = $auth->createPermission('deleteProject');
        $deleteProject->description = 'Удалени проекта';
        $auth->add($deleteProject);

        $createViewOwnerProjects = $auth->createPermission('createViewOwnerProject');
        $createViewOwnerProjects->description = 'Просмотр и редактирование своих проектов';
        $rule = new OwnerProjectRule();
        $createViewOwnerProjects->ruleName = $rule->name;
        $auth->add($rule);
        $auth->add($createViewOwnerProjects);

        $createViewOwnerTasks = $auth->createPermission('createViewOwnerTasks');
        $createViewOwnerTasks->description = 'Просмотр и редактирование своих задач';
        $rule = new OwnerTaskRule();
        $createViewOwnerTasks->ruleName = $rule->name;
        $auth->add($rule);
        $auth->add($createViewOwnerTasks);

        $createViewManagerProjects = $auth->createPermission('createViewManagerProject');
        $createViewManagerProjects->description = 'Просмотр и редактирование задач менеджером проекта';
        $rule = new ManagerProjectRule();
        $createViewManagerProjects->ruleName = $rule->name;
        $auth->add($rule);
        $auth->add($createViewManagerProjects);

        $createViewAllProjectsTasks = $auth->createPermission('createViewAllProjectsTasks');
        $createViewAllProjectsTasks->description = 'Просмотр и редактировани любых проектов';
        $auth->add($createViewAllProjectsTasks);

        // добавляем роль "user"
        $user = $auth->getRole('user');
        $auth->addChild($user, $createProject);
        $auth->addChild($user, $editProject);
        $auth->addChild($user, $createViewOwnerProjects);
        $auth->addChild($user, $createViewManagerProjects);
        $auth->addChild($user, $createViewOwnerTasks);

        // добавляем роль "admin"
        // а также все разрешения роли "user"
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $blockProject);
        $auth->addChild($admin, $deleteProject);
        $auth->addChild($admin, $createViewAllProjectsTasks);
    }
}