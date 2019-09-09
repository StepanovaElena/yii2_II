<?php


namespace common\components;


use app\models\Activity;
use common\models\Tasks;
use Yii;
use yii\base\Component;
use yii\web\NotFoundHttpException;

class TaskComponent extends Component
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

    public function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function getAllTasks($params = [])
    {
        return Tasks::find()
            ->where($params)
            ->all();
    }

}