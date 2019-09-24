<?php


namespace frontend\controllers\actions\task;

use yii\base\Action;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class DeleteAction extends Action
{
    public function run($id)
    {
        $model = \Yii::$app->task->findModel($id);

        if (!\Yii::$app->rbac->canDeleteProjects($model)) {
            throw new HttpException(403, 'You are not authorized to delete this project.');
        }

        if (\Yii::$app->task->deleteProject($model)) {
            return $this->controller->redirect(['index']);
        }
    }
}