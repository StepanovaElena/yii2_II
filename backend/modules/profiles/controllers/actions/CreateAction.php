<?php


namespace backend\modules\profiles\controllers\actions;


use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\services\contracts\ProfileService;
use yii\base\Action;

class CreateAction extends Action
{
    /** @var ProfileService */
    private $service;

    public function __construct($id, $module, ProfileService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function run() {
        $model = \Yii::$container->get(ProfileCreateForm::class);
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($profile = $this->service->createProfile($model)) {
                return $this->controller->redirect(['view', 'uuid' => $profile->getUuid()]);
            }
        }
        return $this->controller->render('create', ['model' => $model]);
    }
}