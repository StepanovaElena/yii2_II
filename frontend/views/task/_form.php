<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['row' => 10, 'maxlength' => true]) ?>
        <?= $form->field($model, 'executor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username')) ?>
        <?= $form->field($model, 'created_by')->input('text', ['disabled' => 'disabled']) ?>
        <?= $form->field($model, 'project_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Projects::find()->all(), 'id', 'title')) ?>
    </div>

    <div class="col-md-6">
        <?= $form->field($model, 'started_at')->widget(\kartik\date\DatePicker::classname(),
            [
                'options' => ['placeholder' => 'dd.mm.yyyy'],

                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'

                ]
            ]) ?>
        <?= $form->field($model, 'completed_at')->widget(\kartik\date\DatePicker::classname(),
            [
                'options' => ['placeholder' => 'dd.mm.yyyy'],
                'pluginOptions' => [
                    'autoclose' => true,
                    'format' => 'dd.mm.yyyy'
                ]
            ]) ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

