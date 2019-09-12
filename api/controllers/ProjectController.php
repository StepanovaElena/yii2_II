<?php

namespace api\controllers;


use Yii;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;


class ProjectController extends ActiveController
{
    public $modelClass = 'api\models\Projects';

    //public function behaviors()
    //{
    //    $beh = parent::behaviors();
    //    $beh['authorization'] = [HttpBearerAuth::class];
//
    //    return $beh;
    //}
}
