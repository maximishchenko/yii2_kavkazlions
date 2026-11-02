<?php

declare(strict_types=1);

namespace backend\assets;

use backend\assets\BaseAssetBundle;

final class AppAsset extends BaseAssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/backend.css',
        'css/jquery-ui.css',
    ];
    public $js = [
        'js/jquery-ui.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD
    );
}
