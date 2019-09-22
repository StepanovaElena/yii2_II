<?php


namespace common\components;

use common\components\sender\Sender;
use common\models\Projects;
use common\models\Tasks;
use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\web\NotFoundHttpException;

class TaskComponent extends Component
{
    /**
     * @var Sender
     */
    private $sender;

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

    public function __construct(Sender $sender, $config = [])
    {
        parent::__construct($config);
        $this->sender = $sender;
    }

    public function createTask(Tasks &$model)
    {
        $model->on($model::EVENT_ADD_ROLE, function (Event $event) {
            $this->sender->sendEmail($event->data);
        });

        if ($model->save()) {
            $model->trigger($model::EVENT_ADD_ROLE);
            return true;
        }
        return false;
    }

    public function updateTask(Tasks &$model)
    {
        $model->updated_by = \Yii::$app->user->getId();
        $model->updated_at = date('Y-m-d H:m:s');

        if (!$model->validate()) {
            return false;
        }
        return $model->save();
        //return $model->updateAttributes(['status', 'description', 'updated_by', 'updated_at']);
    }

    public function deleteTask(Tasks &$model)
    {
        return $model->delete();
    }

    public function viewTask(Tasks &$model)
    {

    }

    public function getProjectTasks($id)
    {
        return \Yii::$app->task->getAllTasks([
            'project_id' => $id
        ]);
    }

}