<?php


namespace backend\modules\profiles\services\contracts;

use backend\modules\profiles\entities\Profile;
use backend\modules\profiles\services\dto\ProfileEditStorageDTO;
use backend\modules\profiles\services\dto\ProfileSaveStorageDTO;

interface ProfileStorage
{
    public function save(ProfileSaveStorageDTO $DTO);//: ?Profile;

    public function edit(ProfileEditStorageDTO $DTO);//: ?Profile;

    public function findProfileByUsernameAndEmail(string $username, string $email);//: ?Profile;

    public function findProfileByUuid(string $uuid);//: ?Profile;
}