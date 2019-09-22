<?php


namespace frontend\controllers\actions\project;

use common\models\Projects;
use yii\base\Action;
use yii\web\HttpException;

class CreateAction extends Action
{
    public function run()
    {
        if (!\Yii::$app->rbac->canCreateProjects()) {
            throw new HttpException(403, 'Not authorisation');
        }

        $project = \Yii::$app->project->getEntity();

        $project->created_by = \Yii::$app->user->getId();

        if (\Yii::$app->request->isPost) {
            $data=\Yii::$app->request->post($project->formName());
            $participants = $data[Projects::RELATION_PARTICIPANTS] ?? null;
            if ($participants !== null){
                $project->participants = $participants === '' ? [] : $participants;
            }
            $project->load(\Yii::$app->request->post());

            if (\Yii::$app->project->createProject($project)) {
                return $this->controller->redirect(['view', 'id' => $project->id]);
            }
        }

        return $this->controller->render('create', ['model' => $project]);
    }
}