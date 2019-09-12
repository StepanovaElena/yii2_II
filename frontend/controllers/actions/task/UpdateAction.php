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
            throw new HttpException(404, 'Activity not found!');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('update', [
            'model' => $model,
        ]);
    }
}