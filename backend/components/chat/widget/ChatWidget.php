<?php


namespace backend\components\chat\widget;


use yii\bootstrap\Widget;

class ChatWidget extends Widget
{
    public $directoryAsset;

    public function init()
    {
        ChatAsset::register($this->view);
    }

    public function run()
    {
        return $this->render('index', ['directoryAsset' => $this->directoryAsset]);
    }
}