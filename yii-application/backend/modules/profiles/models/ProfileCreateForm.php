<?php


namespace backend\modules\profiles\models;


use yii\base\Model;

class ProfileCreateForm extends Model
{
    public $username;
    public $email;
    public $password;

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 5]
        ];
    }
}