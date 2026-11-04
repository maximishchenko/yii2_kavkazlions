<?php

use yii\i18n\PhpMessageSource;
use yii\log\FileTarget;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en',
    'homeUrl' => '',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    // 'on beforeRequest' => function () {
    //     if (Yii::$app->configManager->getItemValue('isWebSiteOffline') == true) {
    //         Yii::$app->catchAll = [
    //           'site/offline', 
    //           'name' => "Обслуживание",
    //           'message' => "Производится обслуживание сайта"
    //         ];
    //     }
    // },
    'components' => [
        'themeManager' => [
            'class' => 'frontend\components\ThemeManager',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'frontend\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            'name' => 'advanced-frontend',
        ],
        'assetManager' => [
            'bundles' => YII_ENV_PROD ? require(__DIR__.'/assets-prod.php') : [],
            'linkAssets' => true,
            'appendTimestamp' => true,
            'hashCallback' => require __DIR__ . '/asset-hash.php',
            'converter' => [
                'class' => 'lucidtaz\yii2scssphp\ScssAssetConverter',
                // В dev пересобираем SCSS при каждом запросе: конвертер следит
                // только за mtime main.scss и не замечает изменений в partials (_*.scss)
                'forceConvert' => YII_ENV_DEV,
            ],
        ],
        'view' => [
            'theme' => [
                'basePath' => '@frontend/themes/v1',
                'baseUrl' => '@frontend/themes/v1',
                'pathMap' => [
                    '@frontend/views' => [
                        '@frontend/themes/v1/views',
                    ],
                    '@frontend/modules' => [
                        '@frontend/themes/v1/modules',
                    ],
                ],
            ],
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
                ],
                'on missingTranslation' => ['common\components\TranslationEventHandler', 'handleMissingTranslation']
            ],
        ], 
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
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
                '' => 'site/index',
                'management/<companySlug:[\w-]+>/<slug:[\w-]+>' => 'management/leader',
                'management/<slug:[\w-]+>' => 'management/view',
                'sponsors' => 'sponsors/index',
            ],
        ],
    ],
    'params' => $params,
];
