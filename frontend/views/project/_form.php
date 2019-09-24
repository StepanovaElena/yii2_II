<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'description')->textarea(['row' => 10, 'maxlength' => true]) ?>
        <?= $form->field($model, 'created_by')->input('text', ['value' => $model->getUsername(), 'disabled' => 'disabled']) ?>
        <?= $form->field($model, 'status')->input('text', ['value' => $model::STATUSES[0], 'disabled' => 'disabled']) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, \common\models\Projects::RELATION_PARTICIPANTS)->widget
        (\unclead\multipleinput\MultipleInput::class, [
            'id' => 'project-users-widget',
            'max' => 10,
            'min' => 0,
            'allowEmptyList' => false,
            'enableGuessTitle' => true,
            'addButtonPosition' => \unclead\multipleinput\MultipleInput::POS_HEADER,
            'columns' => [
                [
                    'name' => 'project_id',
                    'type' => 'hiddenInput',
                    'defaultValue' => $model->id,
                ],
                [
                    'name' => 'user_id',
                    'type' => 'dropDownList',
                    'title' => Yii::t('app', 'Participant'),
                    'items' => \common\models\User::getUsersAsList()
                ],
                [
                    'name' => 'role',
                    'type' => 'dropDownList',
                    'title' => Yii::t('app', 'Function'),
                    'items' => \common\models\Participants::ROLES
                ],
            ]
        ])->label(Yii::t('app', 'Add participants and assign roles'));
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <?= $form->field($model, 'loadFile[]')->fileInput(['multiple' => true]) ?>
    </div>
</div>

<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

