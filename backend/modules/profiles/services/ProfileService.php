<?php


namespace backend\modules\profiles\services;

use backend\modules\profiles\entities\Profile;
use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\models\ProfileEditForm;
use backend\modules\profiles\services\contracts\ProfileStorage;
use backend\modules\profiles\services\dto\ProfileEditStorageDTO;
use backend\modules\profiles\services\dto\ProfileSaveStorageDTO;
use Ramsey\Uuid\Uuid;
use yii\base\Event;
use yii\log\Logger;

class ProfileService implements \backend\modules\profiles\services\contracts\ProfileService
{
    /** @var ProfileStorage */
    private $storage;

    private $logger;

    /**
     * ProfileService constructor.
     * @param ProfileStorage $storage
     * @param Logger $logger
     */
    public function __construct(ProfileStorage $storage, Logger $logger)
    {
        $this->storage = $storage;
        $this->logger = $logger;
    }

    public function createProfile(ProfileCreateForm &$model)//: ?Profile
    {
        $model->on($model::EVENT_USER_EXIST, function (Event $event) {
            $this->logger->log('send email' . $event->name);
        });

        if (!$model->validate()) {
            return null;
        }
        if ($this->storage->findProfileByUsernameAndEmail($model->username, $model->email)) {
            $model->addError('username', 'Пользователь с таким именем или email уже есть в системе');
            return null;
        }
        $dto = $this->generateDtoFromCreateForm($model);
        if ($profile = $this->storage->save($dto)) {
            \Yii::$app->rbac->addUserRole($profile->getId());
            return $profile;
        } else {
            return null;
        }
    }

    private function generateDtoFromCreateForm(ProfileCreateForm $form)//: ProfileSaveStorageDTO
    {
        $dto = new ProfileSaveStorageDTO(
            (string)Uuid::uuid4(),
            $form->username,
            $form->email,
            \Yii::$app->security->generatePasswordHash($form->password),
            \Yii::$app->security->generateRandomString(),
            10,
            \Yii::$app->security->generateRandomString());
        return $dto;
    }

    public function editProfile(ProfileEditForm &$model)//: ?Profile
    {
        if (!$model->validate()) {
            return null;
        }

        //if ($this->storage->findProfileByUsernameAndEmail($model->username, $model->email)) {
        //    $model->addError('username', 'Пользователь с таким именем или email уже есть в системе');
        //    return null;
        //}

        $dto = $this->generateDtoFromEditForm($model);
        if ($profile = $this->storage->edit($dto)) {
            return $profile;
        } else {
            return null;
        }
    }

    private function generateDtoFromEditForm(ProfileEditForm $form)//: ProfileEditStorageDTO
    {
        $dto = new ProfileEditStorageDTO(
            $form->uuid,
            $form->username,
            $form->email,
            \Yii::$app->security->generatePasswordHash($form->password),
            $form->status);
        return $dto;
    }

    public function getProfileByUuid($uuid)
    {
        $profile = $this->storage->findProfileByUuid($uuid);
        if ($profile) {
            return $profile;
        } else {
            return null;
        }
    }

}