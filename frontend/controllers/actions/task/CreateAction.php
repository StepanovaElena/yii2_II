<?php


namespace frontend\controllers\actions\task;


use common\models\Tasks;
use Yii;
use yii\base\Action;

class CreateAction extends Action
{
    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function run()
    {
        $model = \Yii::$app->task->getEntity();

        $model->created_by = \Yii::$app->user->getIdentity()->username;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}