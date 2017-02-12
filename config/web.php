<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'library',
    'basePath' => dirname(__DIR__),
    'language' => 'en-US', // en-US ru-RU
    'bootstrap' => ['log'],
    'defaultRoute' => 'catalog',
    'components' => [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => yii\i18n\PhpMessageSource::class,
                    //'basePath' => '@app/messages',
                    //'sourceLanguage' => 'en-US',
                    // 'fileMap' => [
                    //     'app/library'       => 'library.php',
                    // ],
                    'on missingTranslation' => [app\components\TranslationEventHandler::class, 'handleMissingTranslation'],
                ],
            ],
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'iZZdw8RISk-xFl6o-tV4sK9MwlhMN4b6',
        ],
        'cache' => [
            'class' => yii\caching\MemCache::class,
            'useMemcached' => true,
            'servers' => [
                [
                    'host' => '127.0.0.1',
                    'port' => 11211,
                    'weight' => 60,
                ],
            ],
        ],
        'user' => [
            'class'           => app\components\User::class,
            'identityClass'   => app\models\User::class,
            'loginUrl'        => '/auth/login',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'main/error',
        ],
        'mailer' => [
            'class' => yii\swiftmailer\Mailer::class,
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                'catalog'                                                            => 'catalog/index',
                'item/<alias:([\w-]+)>'                                              => 'catalog/view',

                '<controller:([\w-]+)>/<action:([\w-]+)>'                            => '<controller>/<action>',

                '<module:([\w-]+)>/<controller:([\w-]+)>/<id:\d+>/<action:([\w-]+)>' => '<module>/<controller>/<action>',
                '<module:([\w-]+)>/<controller:([\w-]+)>/<id:\d+>'                   => '<module>/<controller>/view',
                '<module:([\w-]+)>/<controller:([\w-]+)>'                            => '<module>/<controller>/index',
            ],
        ],
    ],
    'modules' => [
        'librarian' => [
            'class' => app\modules\librarian\Module::class,
        ],
        'reader' => [
            'class' => app\modules\reader\Module::class,
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => yii\debug\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => yii\gii\Module::class,
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
