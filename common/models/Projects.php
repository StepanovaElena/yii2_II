<?php

namespace common\models;

use common\behaviors\UsernameBehavior;
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
    const STATUS_NONACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BLOCKED = 2;

    const STATUSES = [
        self::STATUS_ACTIVE => 'В работе',
        self::STATUS_NONACTIVE => 'Неактивен',
        self::STATUS_BLOCKED => 'Блокирован',
    ];

    public $loadFile;
    public $file_delete;

    public function rules()
    {
        return array_merge([
            ['status','in','range' => array_keys(self::STATUSES)],
            [['created_by'], 'safe'],
            ['loadFile','file','extensions' => ['jpg','png','pdf'], 'maxFiles' => 5],
            ['file_delete', 'boolean']
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
            ['class' => BlameableBehavior::class],
        ];
    }
    public function beforeValidate()
    {
        $this->created_by = \Yii::$app->user->getId();

        return parent::beforeValidate();
    }
}
