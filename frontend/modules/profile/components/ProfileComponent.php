<?php


namespace frontend\modules\profile\components;


use common\models\Projects;
use common\models\Tasks;
use common\models\Users;
use yii\base\Component;

class ProfileComponent extends Component
{
    public $classEntity;


    public function init()
    {
        parent::init();

        if (empty($this->classEntity)) {
            throw new \Exception('classEntity param required');
        }
    }

    public function getEntity()
    {
        return new $this->classEntity;
    }

    public function updateProfile(Users &$model)
    {
       if (!$model->validate()) {
            return false;
        }
        return $model->save();
    }

    public function findModel()
    {
        return Users::findOne(\Yii::$app->user->identity->getId());
    }

    public function findProjects() {
        return Projects::find()->joinWith('participants')->andWhere(['user_id' => \Yii::$app->user->identity->getId()])->orderBy(['id' => SORT_DESC])->limit(10)->all();
    }

    public function findActiveProjects() {
        $projects = Projects::find()->joinWith('participants')->andWhere(['user_id' => \Yii::$app->user->identity->getId(), 'status' => 1])->all();
        return count($projects);
    }

    public function findUserTasks() {
        $tasks = Tasks::find()->andWhere(['executor_id' => \Yii::$app->user->identity->getId()])->all();
        return count($tasks);
    }
}