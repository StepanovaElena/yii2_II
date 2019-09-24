<?php
\dmstr\web\AdminLteAsset::register($this);

$this->title = Yii::t('app', 'User Profile');
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="content">
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center"><?= $model->username ?></h3>

                    <p class="text-muted text-center">Software Engineer</p>

                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Active projects</b> <a class="pull-right"><?= $active ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Tasks</b> <a class="pull-right"><?= $tasks ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Total projects</b> <a class="pull-right"><?= $count ?></a>
                        </li>
                    </ul>

                    <a class="btn btn-primary btn-block" href="<?= Yii::$app->urlManager->createUrl(['profile/update', 'id' => $model->id]) ?>">
                        <b><?= Yii::t('app', 'Profile Update') ?></b>
                    </a>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Latest Projects</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">

                        <table class="table no-margin">
                            <thead>
                            <tr>
                                <th>Project ID</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($projects as $project): ?>
                                <tr>
                                    <td>
                                        <a href="<?= Yii::$app->urlManager->createUrl(['project/view', 'id' => $project->id]) ?>">
                                            <?= $project->id ?>
                                        </a>
                                    </td>
                                    <td><?= $project->title ?></td>

                                    <?php if ($project->status == '0'): ?>
                                        <td>
                                            <span class="label label-warning"><?= Yii::t('app', 'Not Active') ?></span>
                                        </td>
                                    <?php elseif ($project->status == '1'): ?>
                                    <td>
                                        <span class="label label-success"><?= $project->status ?></span></td>
                                    <td>
                                        <?php else: ?>
                                    <td>
                                        <span class="label label-danger"><?= $project->status ?></span></td>
                                    <td>
                                        <?php endif; ?>
                                    <td>
                                        <?= $project->created_at ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <a class="btn btn-sm btn-info btn-flat pull-left"
                       href="<?= Yii::$app->urlManager->createUrl(['project/create']) ?>">
                        Create New Project
                    </a>
                    <a class="btn btn-sm btn-default btn-flat pull-right"
                       href="<?= Yii::$app->urlManager->createUrl(['project/index']) ?>">
                        View Projects
                    </a>
                </div>
                <!-- /.box-footer -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
