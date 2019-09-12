<?php


namespace backend\modules\profiles\models;


use yii\base\Model;

class ProfileEditForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $status;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const STATUSES = [
        self::STATUS_ACTIVE => 'Активен',
        self::STATUS_INACTIVE => 'Неактивен',
        self::STATUS_DELETED => 'Блокирован',
    ];

    public function rules()
    {
        return [
            [['username', 'email', 'password', 'status'], 'required'],
            ['email', 'email'],
            ['password', 'string', 'min' => 5],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }
}