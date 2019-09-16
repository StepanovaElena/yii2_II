<?php


namespace backend\components\chat\widget;


use yii\web\AssetBundle;

class ChatAsset extends AssetBundle
{
    public $sourcePath = '@backend/components/chat/widget/source';

//    public $css = [
//        'css/site.css',
//    ];
    public $js = [
        'js/chat.js'
    ];
//    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//    ];
}