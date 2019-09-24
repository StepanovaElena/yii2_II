<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'container' => [
        'singletons' => [
            \common\components\sender\Sender::class => [
                ['class' => \common\components\services\SenderService::class],
                [\yii\di\Instance::of('mailer')]
            ],
            'mailer' => function () {
                return Yii::$app->mailer;
            }
        ]
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'task' => [
            'class' => \common\components\TaskComponent::class,
            'classEntity' => \common\models\Tasks::class
        ],
        'project' => [
            'class' => \common\components\ProjectComponent::class,
            'classEntity' => \common\models\Projects::class
        ],
        'rbac' => [
            'class' => \common\components\RbacComponent::class
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
            'enableSwiftMailerLogging' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mail.ru',
                'username' => 'stepanova_eg@bk.ru',
                'password' => 'hel86step25gen07',
                'port' => '587',
                'encryption' => 'tls'
            ]
        ],
    ],
];
