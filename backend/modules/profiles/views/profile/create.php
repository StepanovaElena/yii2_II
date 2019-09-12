<?php
/* @var $this \yii\web\View */
/* @var $model \backend\modules\profiles\models\ProfileCreateForm */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<h2><?=Yii::t('app','Create ProfileCreateForm')?></h2>

<div class="row">
    <div class="col-md-12">
        <?php $form=ActiveForm::begin(['method' => 'POST'])?>
        <?=$form->field($model,'username')?>
        <?=$form->field($model,'email');?>
        <?=$form->field($model,'password')?>

        <?= Html::button('Создать пользователя',['class'=>'btn btn-default','type'=>'submit']) ?>
        <?php ActiveForm::end();?>
    </div>
</div>
