<?php


namespace backend\modules\profiles\services;

use backend\modules\profiles\entities\Profile;
use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\models\ProfileEditForm;
use backend\modules\profiles\services\contracts\ProfileStorage;
use backend\modules\profiles\services\dto\ProfileEditStorageDTO;
use backend\modules\profiles\services\dto\ProfileSaveStorageDTO;
use Ramsey\Uuid\Uuid;

class ProfileService implements \backend\modules\profiles\services\contracts\ProfileService
{
    /** @var ProfileStorage */
    private $storage;

    /**
     * ProfileService constructor.
     * @param ProfileStorage $storage
     */
    public function __construct(ProfileStorage $storage)
    {
        $this->storage = $storage;
    }

    public function createProfile(ProfileCreateForm &$model)//: ?Profile
    {
        if (!$model->validate()) {
            return null;
        }
        if ($this->storage->findProfileByUsernameAndEmail($model->username, $model->email)) {
            $model->addError('username', 'Пользователь с таким именем или email уже есть в системе');
            return null;
        }
        $dto = $this->generateDtoFromCreateForm($model);
        if ($profile = $this->storage->save($dto)) {
            return $profile;
        } else {
            return null;
        }
    }

    private function generateDtoFromCreateForm(ProfileCreateForm $form)//: ProfileSaveStorageDTO
    {
        $dto = new ProfileSaveStorageDTO((string)Uuid::uuid4(), $form->username, $form->email,
            \Yii::$app->security->generatePasswordHash($form->password),
            \Yii::$app->security->generateRandomString(),
            10,
            \Yii::$app->security->generateRandomString());
        return $dto;
    }

    public function editProfile(ProfileEditForm &$model, $uuid)//: ?Profile
    {
        if (!$model->validate()) {
            return null;
        }

        if ($this->storage->findProfileByUsernameAndEmail($model->username, $model->email)) {
            $model->addError('username', 'Пользователь с таким именем или email уже есть в системе');
            return null;
        }

        $dto = $this->generateDtoFromEditForm($model);
        if ($profile = $this->storage->edit($dto, $uuid)) {
            return $profile;
        } else {
            return null;
        }
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

    private function generateDtoFromEditForm(ProfileEditForm $form)//: ProfileEditStorageDTO
    {
        $dto = new ProfileEditStorageDTO(
            $form->username,
            $form->email,
            \Yii::$app->security->generatePasswordHash($form->password),
            $form->status);
        return $dto;
    }

}