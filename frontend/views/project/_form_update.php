<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
/* @var $files */

?>

<?php $form = ActiveForm::begin([
    'options' => [
        'enctype' => 'multipart/form-data',
        'layout' => 'horizontal',
        'fieldConfig' => ['horizontalCssClasses' =>
            [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-4',
                'wrapper' => 'col-sm-8',
                'error' => '',
                'hint' => '',
            ]
        ]
    ]
]); ?>

<div class="row">
    <div class="col-md-6">
        <?= $form->field($model, 'description')->textarea(['row' => 10, 'maxlength' => true]) ?>
        <?= $form->field($model, 'status')->dropDownList($model::STATUSES) ?>
        <?= $form->field($model, 'loadFile[]')->fileInput(['multiple' => true]) ?>
    </div>
    <div class="col-md-6">
        <?= $form->field($model, \common\models\Projects::RELATION_PARTICIPANTS)
            ->widget(\unclead\multipleinput\MultipleInput::class, [
            'id' => 'project-users-widget',
            'max' => 10,
            'min' => 0,
            'allowEmptyList' => false,
            'enableGuessTitle' => true,
            'addButtonPosition' => \unclead\multipleinput\MultipleInput::POS_HEADER,
            'columns' => [
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
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

