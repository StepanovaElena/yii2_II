<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log', \backend\config\PreConfig::class],
    'language' => 'ru-Ru',
    'container' => [
        'singletons' => [
            \backend\modules\profiles\services\contracts\ProfileStorage::class => [
                ['class' => \backend\modules\profiles\infrastructure\ProfileStorageMysql::class],
                [\yii\di\Instance::of('db_conn')]
            ],
            //'profile' => ['class' => \backend\modules\profiles\services\contracts\ProfileService::class],
            'db_conn' => function () {
                return Yii::$app->db;
            },
            \backend\modules\profiles\services\contracts\ProfileService::class =>
                ['class' => \backend\modules\profiles\services\ProfileService::class]
        ],
        'definitions' => [],
    ],

    'modules' => [
        'profiles' => [
            'class' => 'backend\modules\profiles\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'profile/<action>' => 'profiles/profile/<action>'
            ],

        ],
    ],
    'params' => $params,
];
