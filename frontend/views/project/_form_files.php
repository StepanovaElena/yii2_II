<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Project files</h3>

    </div>
    <div class="box-body">
        <?php if (!empty($files)): ?>
            <p class="text-muted">Click on any file for downloading</p>
            <ul class="list-inline">
                <?php foreach ($files as $file): ?>
                    <li>
                        <i class="fa fa-share margin-r-5"></i>
                        <?= \yii\helpers\Html::a($file, ['project/download', 'id' => $model->id, 'name' => $file], [
                            'data' => [
                                'method' => 'post',
                            ],
                        ]) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p class="text-muted">There are no files available for download.</p>
        <?php endif; ?>

    </div>
</div>

