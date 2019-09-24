<?php


namespace frontend\controllers\actions\task;


use yii\base\Action;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ViewAction extends Action
{
    public function run($id)
    {
        $model = \Yii::$app->task->findModel($id);

        if (!\Yii::$app->rbac->canEditViewTasks($model)) {
            throw new HttpException(403, 'You are not authorized to view this task.');
        }

        return $this->controller->render('view', [
            'model' => $model,
        ]);
    }
}