<?php


namespace backend\modules\profiles\controllers;

use backend\modules\profiles\base\BaseController;
use backend\modules\profiles\controllers\actions\CreateAction;
use backend\modules\profiles\controllers\actions\EditAction;
use backend\modules\profiles\controllers\actions\ViewAction;
use backend\modules\profiles\models\ProfileCreateForm;
use backend\modules\profiles\models\ProfileEditForm;
use backend\modules\profiles\services\contracts\ProfileService;

class ProfileController extends BaseController
{
    public function actions()
    {
        return [
            'create' => ['class' => CreateAction::class],
            'view' => ['class' => ViewAction::class],
            'edit' => ['class' => EditAction::class],

        ];
    }

}
