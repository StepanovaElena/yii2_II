<?php

namespace frontend\controllers;

use frontend\controllers\actions\project\CreateAction;
use frontend\controllers\actions\project\DeleteAction;
use frontend\controllers\actions\project\DownloadAction;
use frontend\controllers\actions\project\UpdateAction;
use frontend\controllers\actions\project\ViewAction;
use Yii;
use common\models\Projects;
use frontend\models\ProjectSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProjectController implements the CRUD actions for Projects model.
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index, create, view, update, delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ]
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'create' => ['class' => CreateAction::class],
            'view' => ['class' => ViewAction::class],
            'update' => ['class' => UpdateAction::class],
            'delete' => ['class' => DeleteAction::class],
            'download' => ['class' => DownloadAction::class]
        ];
    }

    /**
     * Lists all Projects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
