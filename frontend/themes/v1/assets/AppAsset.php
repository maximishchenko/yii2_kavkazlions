<?php

declare(strict_types=1);

namespace frontend\themes\v1\assets;

use frontend\assets\BaseAssetBundle;
use yii\web\View;

class AppAsset extends BaseAssetBundle
{
    public $sourcePath = '@frontend/themes/v1/web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
    ];
    public $jsOptions = [
        'defer' => true,
        'position' => View::POS_END,
    ];
    public $depends = [
        // 'frontend\themes\deffo_v1\assets\NpmAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
    ];
}
