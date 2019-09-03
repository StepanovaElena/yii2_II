<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $executor_id
 * @property string $started_at
 * @property string $completed_at
 * @property int $created_by
 * @property int $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $createdBy
 * @property User $executor
 * @property User $updatedBy
 */
class Tasks extends TasksBase
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        //с учетом родительских правил
        return array_merge([

        ], parent::rules());
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

        ];
    }
}
