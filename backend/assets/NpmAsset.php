<?php

declare(strict_types=1);

namespace backend\assets;

use backend\assets\BaseAssetBundle;

final class NpmAsset extends BaseAssetBundle
{
    public $sourcePath = '@npm';
    public $css = [
        'fancyapps--ui/dist/fancybox/fancybox.css',
    ];
    public $js = [
        'fancyapps--ui/dist/fancybox/fancybox.umd.js',
    ];
    public $depends = [
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'defer' => 'defer',
    );
    public $cssOptions = [
        'media' => "print",
        'onload' => "this.media='all'; this.onload = null",
    ];
}
