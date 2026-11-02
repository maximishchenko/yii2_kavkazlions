<?php

declare(strict_types=1);

namespace frontend\themes\v1\assets;

use frontend\assets\BaseAssetBundle;
use yii\web\View;

class FontPreloadAsset extends BaseAssetBundle
{
    public $sourcePath = '@frontend/themes/v1/web';

    public $css = [
        'fonts/montserrat-cyrillic.woff2',
        'fonts/montserrat-latin.woff2',
    ];

    public $cssOptions = [
        'rel' => 'preload',
        'as' => 'font',
        'type' => 'font/woff2',
        'crossorigin' => 'anonymous',
        'position' => View::POS_HEAD,
    ];
}