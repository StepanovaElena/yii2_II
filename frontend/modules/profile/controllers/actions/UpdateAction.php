<?php


namespace frontend\modules\profile\controllers\actions;

use common\models\Users;
use frontend\modules\profile\components\ProfileComponent;
use yii\base\Action;
use yii\web\HttpException;

class UpdateAction extends Action
{
    public function run()
    {
        $profileComponent = \Yii::createObject([
            'class' => ProfileComponent::class,
            'classEntity' => Users::class
        ]);

        $model = $profileComponent->findModel();
        $model->scenario = Users::SCENARIO_PROFILE;

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());

            if ($model->status !== $model::ACTIVE) {
                throw new HttpException(403, 'This profile is either not confirmed or has been deleted.');
            }

            if (\Yii::$app->project->updateProfile($model)) {
                return $this->controller->redirect(['index', 'id' => $model->id]);
            }
        }
        return $this->controller->render('update', [
            'model' => $model,
        ]);

    }
}