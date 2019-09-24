<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Users */

\dmstr\web\AdminLteAsset::register($this);

$this->title = Yii::t('app', 'Update Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profile'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <h5>User Name: <?= $model->username ?></h5>
        <h5>Email: <?= $model->email ?></h5>
        <p class="text-muted">Created at: <?= $model->created_at ?></p>
    </div>
    <div class="box-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

