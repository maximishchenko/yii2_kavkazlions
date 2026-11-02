<?php

use yii\caching\FileCache;
use yii\caching\DummyCache;
use yii\helpers\ArrayHelper;

return [
    'name' => 'РОО ДЮСШЕ<br/>"Львы Кавказа"',
    'timezone'=> 'Europe/Moscow',
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'configManager' => [
            'class' => 'yii2tech\config\Manager',
            'autoRestoreValues' => true,
            'cacheDuration' => 3600,
            'storage' => [
                'class' => 'yii2tech\config\StoragePhp',
                'fileName' => "@frontend/runtime/app_config.php",
            ],
            'items' => ArrayHelper::merge(
                require __DIR__ . '/_config_main.php',
                []
            ),
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Europe/Moscow',
            'dateFormat' => 'dd.MM.yyyy',
            'timeFormat' => 'HH:ii:ss',
            'datetimeFormat' => 'dd.MM.yyyy HH:mm:ss',
            'locale' => 'ru',
            'currencyCode' => 'RUB',
        ],
        'db' => [
            'enableSchemaCache' => YII_ENV_PROD ? true : false,
        ],
        'cache' => [
            'class' => YII_ENV_PROD ? FileCache::class : DummyCache::class,
        ],
    ],
];
