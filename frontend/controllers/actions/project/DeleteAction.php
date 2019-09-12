<?php


namespace frontend\controllers\actions\project;


use yii\base\Action;
use yii\web\NotFoundHttpException;

class DeleteAction extends Action
{
    /**
     * Deletes an existing Projects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        \Yii::$app->project->findModel($id)->delete();

        return $this->controller->redirect(['index']);
    }


}