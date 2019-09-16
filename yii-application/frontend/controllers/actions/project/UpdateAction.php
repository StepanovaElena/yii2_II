<?php


namespace frontend\controllers\actions\project;


use Yii;
use yii\base\Action;
use yii\web\NotFoundHttpException;

class UpdateAction extends Action
{
    /**
     * Updates an existing Projects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        $model = \Yii::$app->project->findModel($id);

        $files = \Yii::$app->project->getProjectFiles($id);

        $model->load(\Yii::$app->request->post());

        if (\Yii::$app->project->updateProject($model)) {
            return $this->controller->redirect(['view', 'id' => $model->id]);
        }

        return $this->controller->render('update', [
            'model' => $model, 'files' => $files
        ]);
    }
}