<?php

namespace common\models;

use Ramsey\Uuid\Uuid;

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

    public function rules()
    {
        return array_merge([
            ['uuid', 'required'],
        ], parent::rules());
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
