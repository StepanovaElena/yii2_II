<?php

namespace api\controllers;


use Yii;
use yii\rest\ActiveController;


class TaskController extends ActiveController
{
    public $modelClass = 'api\models\Tasks';
}
