<?php


namespace common\behaviors;


use common\models\User;
use yii\base\Behavior;
use yii\base\Controller;

class UsernameBehavior extends Behavior
{
    public $attribute;

    public function events()
    {
        return [
            //Controller::EVENT_BEFORE_ACTION => 'getUsername'
        ];
    }

    public function getUsername(){
        $id = $this->owner->{$this->attribute};
        $user = User::findOne(['id' => $id]);

        return $user->username;
    }
}