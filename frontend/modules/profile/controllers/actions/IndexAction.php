<?php


namespace frontend\modules\profile\controllers\actions;


use common\models\Users;
use frontend\modules\profile\components\ProfileComponent;
use yii\base\Action;

class IndexAction extends Action
{
    public function run()
    {
        $profileComponent = \Yii::createObject([
            'class' => ProfileComponent::class,
            'classEntity' => Users::class
        ]);

        $user = $profileComponent->findModel();
        $projects = $profileComponent->findProjects();
        $count = count($projects);
        $active = $profileComponent->findActiveProjects();
        $tasks = $profileComponent->findUserTasks();


        return $this->controller->render('index', [
            'model' => $user,
            'projects' => $projects,
            'count' => $count,
            'active' => $active,
            'tasks' => $tasks
        ]);
    }
}