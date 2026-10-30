<?php

use yii\caching\FileCache;
use yii\caching\DummyCache;

return [
    'name' => 'KavkazLions',
    'timezone'=> 'Europe/Moscow',
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
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
