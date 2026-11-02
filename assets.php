<?php

use frontend\themes\v1\assets\AppAsset;

Yii::setAlias('@webroot', __DIR__ . '/frontend/web');
Yii::setAlias('@web', '/');

return [
    'jsCompressor' => 'gulp compress-js --gulpfile gulpfileTask.js --src {from} --dist {to}',
    'cssCompressor' => 'gulp compress-css --gulpfile gulpfileTask.js --src {from} --dist {to}',
    'deleteSource' => false,
    'bundles' => [
        'frontend\themes\v1\assets\AppAsset',
    ],
    'targets' => [
        'all' => [
            'class' => AppAsset::class,
            'basePath' => '@webroot/',
            'baseUrl' => '@web/',
            'jsOptions' => [
                'defer' => 'defer',
            ],
            'js' => 'assets/all-{hash}.min.js',
            'css' => 'assets/all-{hash}.min.css',
            'depends' => [],
        ],
    ],
    'assetManager' => [
        'basePath' => '@webroot/assets',
        'baseUrl' => '@web/assets',
        'linkAssets' => true,
        'appendTimestamp' => true,
        'hashCallback' => require __DIR__ . '/frontend/config/asset-hash.php',
        'bundles' => [
            'yii\web\JqueryAsset' => false,
            'yii\bootstrap\BootstrapPluginAsset' => false,
            'yii\bootstrap\BootstrapAsset' => false,
            'yii\web\YiiAsset' => false,
            'yii\widgets\ActiveFormAsset' => false,
        ],
    ],
];