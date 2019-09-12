<?php


namespace backend\modules\profiles\controllers;

use backend\modules\profiles\base\BaseController;
use backend\modules\profiles\infrastructure\ProfileStorageMysql;
use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\models\ProfileEditForm;
use backend\modules\profiles\services\contracts\ProfileService;

class ProfileController extends BaseController
{
    /** @var ProfileService */
    private $service;

    public function __construct($id, $module, $config = [])
    {
        $connection = \Yii::$app->db;
        $storage = new ProfileStorageMysql($connection);
        $this->service = new \backend\modules\profiles\services\ProfileService($storage);
        parent::__construct($id, $module, $config);
    }

    public function actionCreate()
    {
        $model = new ProfileCreateForm();
        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($profile = $this->service->createProfile($model)) {
                return $this->redirect(['/profile/view', 'uuid' => $profile->getUuid()]);
            }
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionEdit($uuid)
    {
        $profile = $this->service->getProfileByUuid($uuid);
        $model = new ProfileEditForm();
        $model->username = $profile->getUsername();
        $model->email = $profile->getEmail();
        $model->status = $profile->getStatus();
        $model->password = '';

        if (\Yii::$app->request->isPost) {
            $model->load(\Yii::$app->request->post());
            if ($this->service->editProfile($model, $uuid)) {
                return $this->redirect(['view', 'uuid' => $uuid]);
            }
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionView($uuid)
    {
        $profile = $this->service->getProfileByUuid($uuid);

        return $this->render('view', ['profile' => $profile]);
    }

}
