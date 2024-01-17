<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'api\controllers',
    'timeZone' => 'Asia/Jakarta',
    'components' => [
        'jwt' => [
            'class' => \bizley\jwt\Jwt::class,
            'signer' => \bizley\jwt\Jwt::HS256,
            'signingKey' => [
                'key' => '6jf9yUOKr9yqZ+KaiQXHs+huOwvKzgX6niiJPOjS5qs bastomi@DESKTOP-3B0C0P2', // path to your PRIVATE key, you can start the path with @ to indicate this is a Yii alias
                'passphrase' => '', // omit it if you are not adding any passphrase
                'method' => \bizley\jwt\Jwt::METHOD_PLAIN,
            ],
            'verifyingKey' => [ // required for asymmetric keys
                'key' => '6jf9yUOKr9yqZ+KaiQXHs+huOwvKzgX6niiJPOjS5qs bastomi@DESKTOP-3B0C0P2', // path to your PUBLIC key, you can start the path with @ to indicate this is a Yii alias
                'passphrase' => '', // omit it if you are not adding any passphrase
                'method' => \bizley\jwt\Jwt::METHOD_PLAIN,
            ],
            'validationConstraints' => static function (\bizley\jwt\Jwt $jwt) {
                $config = $jwt->getConfiguration();
                return [
                    new \Lcobucci\JWT\Validation\Constraint\SignedWith($config->signer(), $config->verificationKey()),
                    new \Lcobucci\JWT\Validation\Constraint\LooseValidAt(
                        new \Lcobucci\Clock\SystemClock(new \DateTimeZone(\Yii::$app->timeZone)),
                        new \DateInterval('PT10S')
                    ),
                ];
            }
        ],
        'request' => [
            'csrfParam' => '_csrf-api',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-api', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the api
            'name' => 'advanced-api',
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
            //'enableStrictParsing' => true,
            'rules' => [
                //['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
                //['class' => 'yii\rest\UrlRule', 'controller' => 'auth'],
                //'<controller:\w+>/<id:\d+>' => '<controller>/view',
                //'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                //'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],

    // api versioning example
    'modules' => [
        'v1' => [
            'class' => 'api\modules\v1\Module',
        ],
        'v2' => [
            'class' => 'api\modules\v2\Module',
        ],
    ],
    'params' => $params,
];
