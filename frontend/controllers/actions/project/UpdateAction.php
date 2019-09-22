<?php


namespace frontend\controllers\actions\project;


use common\models\Projects;
use Yii;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class UpdateAction extends Action
{
    public function run($id)
    {
        $model = \Yii::$app->project->findModel($id);

        if (!\Yii::$app->rbac->canEditViewProjects($model)) {
            throw new HttpException(403, 'You are not authorized to view this project.');
        }

        $model->scenario = Projects::SCENARIO_UPDATE;

        $files = \Yii::$app->project->getProjectFiles($id);

        if (\Yii::$app->request->isPost) {

            $data=\Yii::$app->request->post($model->formName());
            $participants = $data[Projects::RELATION_PARTICIPANTS] ?? null;
            if ($participants !== null){
                $model->participants = $participants === '' ? [] : $participants;
            }
            $model->load(\Yii::$app->request->post());

            if($model->status == $model::STATUS_BLOCKED){
                if (!\Yii::$app->rbac->canBlockedProject($model)) {
                    throw new HttpException(403, 'You do not have sufficient rights to set this status.');
                }
            }

            if (\Yii::$app->project->updateProject($model)) {
                return $this->controller->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->controller->render('update', [
            'model' => $model, 'files' => $files
        ]);
    }
}