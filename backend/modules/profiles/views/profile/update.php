<?php
/* @var $this \yii\web\View */
/* @var $model \backend\modules\profiles\models\ProfileCreateForm
 * */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

\dmstr\web\AdminLteAsset::register($this);
?>
<div class="box box-danger col-md-12">
    <div class="box-header">
        <h3 class="box-title">
        <?=Yii::t('app','Update ProfileCreateForm')?>
        </h3>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6">
                <?php $form=ActiveForm::begin(['method' => 'POST'])?>
                <?=$form->field($model,'username')?>
                <?=$form->field($model,'email');?>
                <?=$form->field($model,'password')?>
                <?=$form->field($model,'status')?>
                <?= Html::button('Обновить',['class'=>'btn btn-default','type'=>'submit']) ?>
                <?php ActiveForm::end();?>
            </div>
        </div>
    </div>
</div>
<h2></h2>


