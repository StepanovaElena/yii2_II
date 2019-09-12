<?php


namespace frontend\controllers\actions\project;


use yii\base\Action;
use yii\web\NotFoundHttpException;

class ViewAction extends Action
{
    /**
     * Displays a single Projects model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function run($id)
    {
        $files = \Yii::$app->project->getProjectFiles($id);
        $tasks = \Yii::$app->project->getProjectTasks($id);

        return $this->controller->render('view', [
            'model' => \Yii::$app->project->findModel($id),
            'files' => $files,
            'tasks' => $tasks
        ]);
    }
}