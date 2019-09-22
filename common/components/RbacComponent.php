<?php


namespace common\components;


use common\models\Projects;
use common\models\Tasks;
use yii\base\Component;
use yii\rbac\ManagerInterface;

class RbacComponent extends Component
{
    public function getAuthManager(): ManagerInterface
    {
        return \Yii::$app->authManager;
    }

    public function canCreateTasks(): bool
    {
        return \Yii::$app->user->can('createTasks');
    }

    public function canCreateProjects(): bool
    {
        return \Yii::$app->user->can('createProject');
    }

    public function canEditViewTasks(Tasks $tasks)
    {
        if (\Yii::$app->user->can('createViewAllProjectsTasks')) {
            return true;
        }
        if (\Yii::$app->user->can('createViewOwnerTasks', ['tasks' => $tasks])) {
            return true;
        }

        if (\Yii::$app->user->can('createViewManagerProject', ['tasks' => $tasks])) {
            return true;
        }
        return false;
    }

    public function canDeleteProject(): bool
    {
        return \Yii::$app->user->can('deleteProject');
    }

    public function canBlockedProject(): bool
    {
        return \Yii::$app->user->can('blockProject');
    }

    public function canEditViewProjects(Projects $projects)    {

        if (\Yii::$app->user->can('createViewAllProjectsTasks')) {
            return true;
        }
        if (\Yii::$app->user->can('createViewOwnerProject', ['projects' => $projects, 'participants' => $projects->participants])) {
            return true;
        }

        return false;
    }

    public function addUserRole($id) {
        $authManager = $this->getAuthManager();
        $authManager->assign($authManager->getRole('user'), $id);
        return true;
    }

    public function getUserRole($id) {
        $authManager = $this->getAuthManager();
        return $authManager->getRolesByUser($id);
    }

    public function isUserAdmin() {
        return \Yii::$app->user->can('admin');
    }
}