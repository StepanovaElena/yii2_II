<?php

namespace frontend\controllers;

use frontend\base\BaseController;
use frontend\controllers\actions\task\CreateAction;
use frontend\controllers\actions\task\DeleteAction;
use frontend\controllers\actions\task\UpdateAction;
use frontend\controllers\actions\task\ViewAction;
use Yii;
use common\models\Tasks;
use frontend\models\search\TaskSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Tasks model.
 */
class TaskController extends BaseController
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
            'create'=>['class'=> CreateAction::class],
            'view' => ['class'=> ViewAction::class],
            'update' => ['class'=> UpdateAction::class],
            'delete' => ['class' => DeleteAction::class]
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
