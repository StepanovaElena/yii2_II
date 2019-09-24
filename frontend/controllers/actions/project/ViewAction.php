<?php


namespace frontend\controllers\actions\project;


use yii\base\Action;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ViewAction extends Action
{
    public function run($id)
    {
        $model = \Yii::$app->project->findModel($id);

        if (!\Yii::$app->rbac->canEditViewProjects($model)) {
            throw new HttpException(403, 'You are not authorized to view this project.');
        }

        $files = \Yii::$app->project->getProjectFiles($id);
        $tasks = \Yii::$app->project->getProjectTasks($id);

        return $this->controller->render('view', [
            'model' => $model,
            'files' => $files,
            'tasks' => $tasks
        ]);
    }
}