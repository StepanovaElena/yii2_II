<?php


namespace backend\modules\profiles\controllers\actions;


use backend\modules\profiles\models\ProfileEditForm;
use backend\modules\profiles\services\contracts\ProfileService;
use yii\base\Action;

class EditAction extends Action
{
    /** @var ProfileService */
    private $service;

    public function __construct($id, $module, ProfileService $service, $config = [])
    {
        $this->service = $service;
        parent::__construct($id, $module, $config);
    }

    public function run($uuid)
    {
        $profile = $this->service->getProfileByUuid($uuid);
        $model = \Yii::$container->get(ProfileEditForm::class);
        $model->uuid = $uuid;
        $model->username = $profile->getUsername();
        $model->email = $profile->getEmail();
        $model->status = $profile->getStatus();
        $model->password = '';

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($this->service->editProfile($model)) {
                return $this->controller->redirect(['view', 'uuid' => $uuid]);
            }
        }
        return $this->controller->render('update', ['model' => $model]);
    }
}