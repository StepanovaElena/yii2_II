<?php


namespace frontend\controllers\actions\task;


use Yii;
use yii\base\Action;
use yii\web\HttpException;

class UpdateAction extends Action
{
    public function run($id)
    {
        $model = \Yii::$app->task->findModel($id);

        if (!$model) {
            throw new HttpException(404, 'Task not found!');
        }

        if (!\Yii::$app->rbac->canEditViewTasks($model)) {
            throw new HttpException(403, 'You are not authorized to view this task.');
        }

        if (\Yii::$app->request->isPost) {

            $model->load(\Yii::$app->request->post());

            if (\Yii::$app->task->updateTask($model)) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }
}