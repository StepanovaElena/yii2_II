<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "participants".
 *
 * @property int $project_id
 * @property int $user_id
 * @property string $role
 *
 * @property Projects $project
 * @property User $user
 */
class Participants extends ParticipantsBase
{
    const ROLE_DEVELOPER = 'developer';
    const ROLE_MANAGER = 'manager';
    const ROLE_TESTER = 'tester';
    const ROLE_CONSULTANT = 'consultant';

    const ROLES = [
        self::ROLE_DEVELOPER => 'developer',
        self::ROLE_MANAGER => 'manager',
        self::ROLE_TESTER => 'tester',
        self::ROLE_CONSULTANT => 'consultant'
    ];
}
