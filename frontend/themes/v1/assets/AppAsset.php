<?php

declare(strict_types=1);

namespace frontend\themes\v1\assets;

use frontend\assets\BaseAssetBundle;
use yii\web\View;

class AppAsset extends BaseAssetBundle
{
    public $sourcePath = '@frontend/themes/v1/web';
    public $css = [
        'scss/main.scss',
    ];
    public $js = [
        'js/main.js',
    ];
    public $jsOptions = [
        'defer' => true,
        'position' => View::POS_END,
    ];
    public $depends = [
        'frontend\themes\v1\assets\FontPreloadAsset',
    ];
}
