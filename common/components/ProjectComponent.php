<?php


namespace common\components;


use common\components\sender\Sender;
use common\models\Projects;
use tests\models\Project;
use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProjectComponent extends Component
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

    public function __construct(Sender $sender, $config = [])
    {
        parent::__construct($config);
        $this->sender = $sender;
    }

    public function createProject(Projects &$model)
    {
        $model->on($model::EVENT_ADD_ROLE, function (Event $event) {
            $this->sender->sendEmail($event->data);
        });

        $loadFile = UploadedFile::getInstances($model, 'loadFile');

        if ($model->save()) {
            $model->trigger($model::EVENT_ADD_ROLE);
            if ($loadFile) {
                $filesArr = [];
                foreach ($loadFile as $item) {
                    if ($file = $this->saveUploadedFile($item, $model->id)) {
                        array_push($filesArr, $file);
                    }
                }
                $model->loadFile = $filesArr;
            }
            return true;
        }
        return false;
    }

    private function saveUploadedFile(UploadedFile $file, $id)
    {
        $path = $this->getPathToSaveImage($id);
        $filename = $this->genFileName($file);
        $path .= DIRECTORY_SEPARATOR . $filename;
        if ($file->saveAs($path)) {
            return $filename;
        } else {
            return null;
        }
    }

    private function getPathToSaveImage($id)
    {
        $path = \Yii::getAlias('@frontend') . '/web/uploads/' . $id;
        FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
        return $path;
    }

    private function genFileName(UploadedFile $file)
    {
        return time() . '_' . $file->getBaseName() . '.' . $file->getExtension();
    }

    public function updateProject(Projects &$model)
    {
        $model->updated_by = \Yii::$app->user->getId();
        $model->updated_at = date('Y-m-d H:m:s');

        $loadFile = UploadedFile::getInstance($model, 'loadFile');
        if ($loadFile) {
            foreach ($loadFile as $item) {
                $filesArr = [];
                if ($file = $this->saveUploadedFile($item, $model->id)) {
                    array_push($filesArr, $file);
                }
            }
            $model->loadFile = $filesArr;
        }

        if (!$model->validate()) {
            return false;
        }
        return $model->save();
        //return $model->updateAttributes(['status', 'description', 'updated_by', 'updated_at']);
    }

    public function deleteProject(Project &$model)
    {
        return $model->delete();
    }

    public function viewProject(Projects &$model)
    {

    }

    public function findModel($id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function getProjectFiles($id)
    {
        $path = \Yii::getAlias('@frontend') . '/web/uploads/' . $id;
        if (is_dir($path)) {
            $files = \yii\helpers\FileHelper::findFiles($path);
        }
        if (isset($files[0])) {
            foreach ($files as $index => $file) {
                $name[] = substr($file, strrpos($file, '/') + 1);
            }
            return $name;
        } else {
            return null;
        }
    }

    public function getProjectTasks($id)
    {
        return \Yii::$app->task->getAllTasks([
            'project_id' => $id
        ]);
    }
}