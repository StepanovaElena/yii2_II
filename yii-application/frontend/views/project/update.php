<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

\dmstr\web\AdminLteAsset::register($this);

$this->title = Yii::t('app', 'Update Project: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
        <p class="text-muted">Created at: <?= $model->created_at ?> by <?= $model->getUsername()?></p>
    </div>
    <div class="box-body">
        <?= $this->render('_form_update', [
            'model' => $model
        ]) ?>
    </div>
</div>

<?= $this->render('_form_files', [
    'model' => $model,
    'files' => $files
]) ?>