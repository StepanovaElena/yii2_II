<?php


namespace frontend\controllers\actions\project;


use common\models\User;
use yii\base\Action;

class CreateAction extends Action
{
    public function run()
    {
        $project = \Yii::$app->project->getEntity();

        $project->created_by = \Yii::$app->user->getIdentity()->username;

        if (\Yii::$app->request->isPost) {
            $project->load(\Yii::$app->request->post());
            if (\Yii::$app->project->createProject($project)) {
                return $this->controller->redirect(['view', 'id' => $project->id]);
            }
        }

        return $this->controller->render('create', ['model' => $project]);
    }
}