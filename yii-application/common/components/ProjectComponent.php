<?php


namespace common\components;


use common\models\Projects;
use Yii;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class ProjectComponent extends Component
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

    public function createProject(Projects &$model)
    {
        $loadFile = UploadedFile::getInstances($model, 'loadFile');

        if ($model->save()) {
            if (!empty($loadFile)) {
                foreach ($loadFile as $item) {
                    if ($file = $this->saveUploadedFile($item, $model->id)) {
                        $model->loadFile[] = $file;
                    }
                }
            }
            return true;
        }
        return false;
    }

    public function updateProject(Projects &$model)
    {
        if ($model->validate()) {
            return false;
        }

        $loadFile = UploadedFile::getInstance($model, 'loadFile');

        if (!empty($loadFile)) {
            foreach ($loadFile as $item) {
                if ($file = $this->saveUploadedFile($item, $model->id)) {
                    $model->loadFile[] = $file;
                }
            }
        };

        return $model->updateAttributes(['status', 'description', 'updated_by', 'updated_at']);
    }

    public function viewProject(Projects &$model)
    {

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
        $files = \yii\helpers\FileHelper::findFiles($path);
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