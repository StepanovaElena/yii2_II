<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tasks */
\dmstr\web\AdminLteAsset::register($this);
$this->title = Yii::t('app', 'Create Tasks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-danger">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
</div>


