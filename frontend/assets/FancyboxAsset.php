<?php

declare(strict_types=1);

namespace frontend\assets;

use frontend\assets\BaseAssetBundle;
use yii\web\View;

final class FancyboxAsset extends BaseAssetBundle
{
    public $sourcePath = '@npm';
    public $css = [
        'fancyapps--ui/dist/fancybox/fancybox.css',
    ];
    public $js = [
        'fancyapps--ui/dist/fancybox/fancybox.umd.js',
    ];
    public $jsOptions = [
        'position' => View::POS_END,
    ];
}
