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
    public function beforeValidate()
    {
        $date = \DateTime::createFromFormat('d.m.Y', $this->started_at);
        if ($date) {
            $this->started_at = $date->format('Y-m-d');
        }

        $dateEnd = \DateTime::createFromFormat('d.m.Y', $this->completed_at);
        if ($date) {
            $this->completed_at = $dateEnd->format('Y-m-d');
        }

        if (empty($dateEnd)) {
            $this->completed_at = $this->started_at;
        }

        if ($dateEnd < $date) {
            $this->addError('completed_at','Дата завершения не может быть раньше даты начала события!');
        }

        $today = (date('Y-m-d'));

        if ($date < $today) {
            $this->addError('started_at','Дата начала не может быть в прошлом!');
        }

        $this->created_by = \Yii::$app->user->getId();

        return parent::beforeValidate();
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        //с учетом родительских правил
        return array_merge([
            [['started_at'], 'date', 'format' => 'php:Y-m-d'],
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
