<?php

declare(strict_types=1);

namespace frontend\assets;

use frontend\assets\BaseAssetBundle;
use yii\web\View;

final class SwiperAsset extends BaseAssetBundle
{
    public $sourcePath = '@npm';
    public $css = [
        'swiper/swiper-bundle.min.css',
    ];
    public $js = [
        'swiper/swiper-bundle.min.js',
    ];
    public $jsOptions = [
        'position' => View::POS_END,
    ];
}
