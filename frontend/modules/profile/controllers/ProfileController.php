<?php


namespace frontend\modules\profile\controllers;


use frontend\base\BaseController;
use frontend\modules\profile\controllers\actions\IndexAction;
use frontend\modules\profile\controllers\actions\UpdateAction;
use yii\filters\AccessControl;

class ProfileController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'index' => ['class' => IndexAction::class],
            'update' => ['class' => UpdateAction::class],
        ];
    }

}