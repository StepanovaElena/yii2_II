<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Projects */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title">Linked Tasks</h3>
    </div>
    <div class="box-body">
        <p>
            <?= Html::a(Yii::t('app', 'Create Tasks'), ['task/create','project_id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'method' => 'post',
                    ]
                ]) ?>
        </p>
        <?php if (!empty($tasks)): ?>
            <p class="text-muted">Click on any task for viewing</p>
            <table class="table no-margin">
                <thead>
                <tr>
                    <th>Task ID</th>
                    <th>Title</th>
                    <th>Executor</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= $task['id'] ?></td>
                        <td><?= $task['title'] ?></td>
                        <td><?= $task['executor_id'] ?></td>
                        <td>
                            <?= \yii\helpers\Html::a('<i class="fa fa-share margin-r-5"></i>', ['task/view', 'id' => $task['id']], [
                                'data' => [
                                    'method' => 'post',
                                ],
                            ]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">There are no tasks for this project yet.</p>

        <?php endif; ?>
    </div>
</div>

