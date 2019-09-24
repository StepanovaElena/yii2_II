<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

\dmstr\web\AdminLteAsset::register($this);

/* @var $this yii\web\View */
/* @var $model common\models\Projects */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="projects-view">

    <div class="box box-primary">
        <div class="box-header">
            <h1 class="box-title"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="box-body">
            <div>
                <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'title',
                    'description',
                    'created_by',
                    'updated_by',
                    'created_at',
                    'updated_at',
                    'status',
                    [
                        'attribute' => 'participants',
                        'format' => 'raw',
                        'value' => function ($model) {
                            if (!empty($model->participants)) {
                                $participants = '';
                                foreach ($model->participants as $person) {
                                    $username = \common\models\User::find()->select(['username'])->where(['id' => $person->user_id])->one();
                                    $participants .= '<p><span class="fa fa-user"></span> '. $username->username . ' - '. $person->role . '</p>';
                                }
                                return $participants;
                            } else {
                                return '<p>Participants are not added.</p>';
                            }
                        }
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <?= $this->render('_form_files', [
        'model' => $model,
        'files' => $files
    ]) ?>

    <?= $this->render('_form_tasks', [
        'model' => $model,
        'tasks' => $tasks
    ]) ?>

</div>
