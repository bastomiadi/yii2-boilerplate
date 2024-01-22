<?php

use kartik\datecontrol\Module;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=>'Yii2 Boilerplate',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'auditlog' => [
            'class' => 'ruturajmaniyar\mod\audit\AuditEntryModule'
        ],
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
            'mainLayout' => '@backend/views/layouts/main.php',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        'datecontrol' =>  [
            'class' => 'kartik\datecontrol\Module',
     
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'php:d-F-Y',
                Module::FORMAT_TIME => 'hh:mm:ss a',
                Module::FORMAT_DATETIME => 'dd-MM-yyyy hh:mm:ss a', 
            ],
            
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:Y-m-d', // saves as default date
                Module::FORMAT_TIME => 'php:H:i:s',
                Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
            ],
     
            // set your display timezone
            'displayTimezone' => 'Asia/Jakarta',
     
            // set your timezone for date saved to db
            'saveTimezone' => 'UTC',
            
            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

            // use ajax conversion for processing dates from display format to save format.
            'ajaxConversion' => false,
     
            // default settings for each widget from kartik\widgets used when autoWidget is true
            'autoWidgetSettings' => [
                Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                Module::FORMAT_DATETIME => [], // setup if needed
                Module::FORMAT_TIME => [], // setup if needed
            ],
            
            // custom widget settings that will be used to render the date input instead of kartik\widgets,
            // this will be used when autoWidget is set to false at module or widget level.
            'widgetSettings' => [
                Module::FORMAT_DATE => [
                    'class' => 'kartik\date\DatePicker', // example
                    'options' => [
                        //'dateFormat' => 'php:d-M-Y',
                        'options' => ['class'=>'form-control'],
                    ]
                ]
            ]
        ]
    ],
    'components' => [
        'dateTimeConversion' => [
            'class' => 'ruturajmaniyar\mod\audit\components\DateTimeHelper'
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => 'google_client_id',
                    'clientSecret' => 'your_google_client_secret',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => 'facebook_client_id',
                    'clientSecret' => 'your_facebook_client_secret',
                ],
                // etc.
            ],
        ],
        'i18n' => [
            'translations' => [
                'yii2-ajaxcrud' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@yii2ajaxcrud/ajaxcrud/messages',
                    'sourceLanguage' => 'en-Us',
                ],
            ]
        ],
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
                    'class' => \yii\log\FileTarget::class,
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
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
		        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
           		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',   			
            ],
        ],
    ],
    'params' => $params,
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            'site/*',
            'admin/*',
            'some-controller/some-action',
            'debug/*',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],
];
