<?php

use yii\rest\UrlRule;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
   /* 'homeUrl' => '/ecommpay',*/
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ViaeT-QVFj6zG9ocu_8CaEbL8E9sXaOk',
            'enableCsrfValidation' => false,
          /*  'baseUrl' => '/ecommpay', // localhost/yii2advance*/

            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
         'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [

                   [ 'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    'logFile' => '@app/runtime/logs/all.log']
                    ,
                    [
                        'class' => 'yii\log\FileTarget',
                        'levels' => ['info'],
                        'categories' => ['my_sp_log'],
                        'logFile' => '@app/runtime/logs/my.log',

                ],
            ],
        ],

      'db' => $db,
       'urlManager' => [
           'enablePrettyUrl' => true,
           'showScriptName' => false,
         //  'enableStrictParsing' => true,
         'rules' => [
             ['class' => 'yii\rest\UrlRule', 'controller' => 'api'],
           /*  [
                 'class' => 'yii\rest\UrlRule',

                 'controller' => ['api'],

                 'extraPatterns' => [

                     'GET /index' => 'index',

                     ]

             ],
             [
                 'class' => 'yii\rest\UrlRule',
                 'controller' => 'api',
                 'pluralize' => false,
                 'extraPatterns' => [
                     'GET foo' => 'foo',
                     'OPTIONS foo' => 'options',
                 ],
                 'except' => ['index', 'create', 'view', 'update', 'delete'],
             ],

*/
              'POST api/callback' => 'site/callback',
         ],
        ],


    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
