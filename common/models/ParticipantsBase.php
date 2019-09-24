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
class ParticipantsBase extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'participants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'user_id'], 'required'],
            [['project_id', 'user_id'], 'integer'],
            [['role'], 'string'],
            //[['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Projects::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_id' => Yii::t('app', 'Project ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'role' => Yii::t('app', 'Role'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Projects::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ParticipantsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ParticipantsQuery(get_called_class());
    }
}
