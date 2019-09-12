<?php


namespace backend\modules\profiles\services\contracts;

use backend\modules\profiles\entities\Profile;
use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\models\ProfileEditForm;

interface ProfileService
{
    public function createProfile(ProfileCreateForm &$model);//: ?Profile;

    public function editProfile(ProfileEditForm &$model, $uuid);//: ?Profile;
}