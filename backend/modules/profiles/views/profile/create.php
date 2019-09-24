<?php
/* @var $this \yii\web\View */

/* @var $model \backend\modules\profiles\models\ProfileCreateForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

\dmstr\web\AdminLteAsset::register($this);

$this->title = Yii::t('app', 'Create Profile');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <?php $form = ActiveForm::begin(['method' => 'POST']) ?>
                <div class="col-md-6">
                    <?= $form->field($model, 'username') ?>
                    <?= $form->field($model, 'email'); ?>
                    <?= $form->field($model, 'password') ?>
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary', 'type' => 'submit']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>