<?php


namespace frontend\controllers\actions\task;


use yii\base\Action;
use yii\web\NotFoundHttpException;

class ViewAction extends Action
{
    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function run($id)
    {
        return $this->controller->render('view', [
            'model' => \Yii::$app->task->findModel($id),
        ]);
    }
}