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
    'bootstrap' => ['log'],
    'modules' => [
        'api' => [
            'class' => 'backend\modules\api\Api',
        ],
    ],
    'aliases'=>[
        '@adminpress' => '@backend/theme/adminpress',
    ],
    'components' => [

        'view' => [
            'theme' => [
                'basePath' => '@backend/theme/adminpress',
                'baseUrl' => '@web/',
                'pathMap' => [
                    '@backend/views' => '@adminpress/views'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'parsers' => [
                'cookieValidationKey'=>'1234',
                'application/json' => 'yii\web\JsonParser',
            ]
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
     //   'assetManager' => [
           // 'forceCopy' => true,
//            'bundles' => [
//                'dosamigos\google\maps\MapAsset' => [
//                    'options' => [
//                        'key' => 'AIzaSyBb3O8n560yQ67V_vrJkTzQVnsBfxL2Q4w',// ใส่ API ตรงนี้ครับ
//                        'language' => 'th',
//                        'version' => '3.1.18'
//                    ]
//                ]
//            ]
      //  ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                'module/<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
            ),
        ],
    ],
    'params' => $params,
];
