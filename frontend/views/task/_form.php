<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

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
</div>




<div class="col-md-6">
    <?= $form->field($model, 'started_at')->input('text')->widget(DatePicker::widget([
        'name' => 'started_at',
        'value' =>  '',
        'options' => ['placeholder' => 'Select issue date ...'],
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]));?>
</div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

