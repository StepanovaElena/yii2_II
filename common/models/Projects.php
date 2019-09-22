<?php

namespace common\models;

use common\behaviors\UsernameBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsTrait;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "projects".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Projects extends ProjectsBase
{
    use SaveRelationsTrait;

    const EVENT_ADD_ROLE = 'add_role';

    const RELATION_PARTICIPANTS = 'participants';

    const SCENARIO_UPDATE = 'update_project';
    const SCENARIO_BLOCKED = 'blocked_project';

    const STATUS_NONACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    const STATUSES = [
        self::STATUS_ACTIVE => 'В работе',
        self::STATUS_NONACTIVE => 'Неактивен',
        self::STATUS_BLOCKED => 'Блокирован',
    ];

    public $loadFile;

    public function rules()
    {
        return array_merge([
            ['status', 'in', 'range' => array_keys(self::STATUSES)],
            [['created_by'], 'safe'],
            ['loadFile', 'file', 'extensions' => ['jpg', 'png', 'pdf'], 'maxFiles' => 5]
        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'loadFile' => Yii::t('app', 'Load File'),
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => UsernameBehavior::class,
                'attribute' => 'created_by',
            ],

            'saveRelations' => [
                'class' => SaveRelationsBehavior::class,
                'relations' => [self::RELATION_PARTICIPANTS],
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function beforeValidate()
    {
        $this->created_by = \Yii::$app->user->getId();

        return parent::beforeValidate();
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[static::SCENARIO_UPDATE] = ['description', 'status', 'updated_by', 'updated_at'];
        return $scenarios;
    }

    public function getParticipantsInfo()
    {
        return $this->getParticipants()->select('role')->indexBy('user_id')->column();
    }

    /**
     * @return Participants|\yii\db\ActiveQuery
     */
    public function getParticipants()
    {
        return $this->hasMany(Participants::className(), ['project_id' => 'id']);
    }

}
