<?php

namespace common\models;

use Ramsey\Uuid\Uuid;
use yii\helpers\ArrayHelper;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $uuid
 */
class Users extends User
{
    const SCENARIO_PROFILE = 'profile';

    public function rules()
    {
        return array_merge([
            ['uuid', 'required'],
        ], parent::rules());
    }

    public function scenarios()
    {
        return ArrayHelper::merge(parent::scenarios(), [
            self::SCENARIO_PROFILE => ['email'],
        ]);
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function generateUuid()
    {
        $this->uuid = (string)Uuid::uuid4();
    }
}
