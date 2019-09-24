<?php


namespace frontend\controllers\actions\task;

use yii\base\Action;
use yii\web\HttpException;

class CreateAction extends Action
{

    public function run()
    {
        if (!\Yii::$app->rbac->canCreateTasks()) {
            throw new HttpException(403, 'Not authorisation');
        }

        $model = \Yii::$app->task->getEntity();
        $model->project_id = \Yii::$app->request->get('project_id');
        $model->created_by = \Yii::$app->user->getId();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if (\Yii::$app->task->createTask($model)) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('create', [
            'model' => $model
        ]);
    }
}