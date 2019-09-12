<?php


namespace frontend\base;


use yii\web\Controller;
use yii\web\HttpException;

class BaseController extends Controller
{
    public function beforeAction($action)
    {
        if (\Yii::$app->user->isGuest) {
            throw new HttpException(401,'Need Auth');
        }

        return parent::beforeAction($action);
    }

}