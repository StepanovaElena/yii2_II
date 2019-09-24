<?php


namespace frontend\controllers\actions\project;


use yii\base\Action;

class DownloadAction extends Action
{
    public function run($id, $name)
    {
        if (\Yii::$app->request->isPost) {
            $path = \Yii::getAlias('@frontend') . '/web/uploads/' . $id . '/' . $name;//
            $file = $path;
            return \Yii::$app->response->sendFile($file);
            } else {
                throw new \Exception('File not found');
            }
    }
}