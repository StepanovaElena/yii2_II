<?php


namespace frontend\controllers\actions\task;


use common\models\Projects;
use common\models\Tasks;
use Yii;
use yii\base\Action;
use yii\web\HttpException;

class CreateAction extends Action
{
    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */

    public function run()
    {
        if (!\Yii::$app->rbac->canCreateTasks()) {
            throw new HttpException(403, 'Not authorisation');
        }



        $model = \Yii::$app->task->getEntity();

        $model->created_by = \Yii::$app->user->getId();

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if (\Yii::$app->task->createTask($model)) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('create', [
            'model' => $model,
        ]);
    }
}