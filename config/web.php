<?php

$params = require(__DIR__ . '/params.php');

$config_local = require(__DIR__ . '/web-local.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'version' => '0.7',
    'language' => 'en',
    'defaultRoute' => 'goal/index',
    'modules' => [
        'settings' => [
            'class' => 'app\modules\settings\Module',
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'mqbK_IwJr5r1qcA0_jn2fF9wh3MH9c7s',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // раскоментить, если надо включить точное определение пути
            //'enableStrictParsing' => true,
            'rules' => [
                'goal/message' => 'goal/message',
                'goal/update' => 'goal/update',
                'goal/create' => 'goal/create',
                'goal/<alias:[\w-_]+>' => 'goal/view',
            ]
        ],
        'i18n' => array(
            'translations' => array(
                '*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ),
        ),
        'formatter' => [
            'class' => 'app\helper\Formatter'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        'allowedIPs' => ['192.168.0.*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['192.168.0.*'],
    ];
}

$config = \yii\helpers\ArrayHelper::merge($config, $config_local);

return $config;
