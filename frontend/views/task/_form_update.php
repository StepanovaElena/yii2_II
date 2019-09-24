<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'description')->textarea(['row' => 10, 'maxlength' => true]) ?>
        <?= $form->field($model, 'project_id')->input('text', ['value' => $model->getTitle(), 'disabled' => 'disabled'])->label('Project') ?>
        <?= $form->field($model, 'executor_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Participants::find()->andWhere(['project_id' => $model->project_id])->all(), 'id', 'user_id')) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, 'started_at')->input('text', ['disabled' => 'disabled']) ?>
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
    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

</div>
