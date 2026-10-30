<?php

declare(strict_types=1);

namespace frontend\themes\v1\assets;

use Yii;
use frontend\assets\BaseAssetBundle;

class ThemesAsset extends BaseAssetBundle
{
    public $sourcePath ='@frontend/themes/v1/web';
    
    /**
     * URL опубликованного файла темы с версией (?v=timestamp).
     */
    public function url(string $path): string
    {
        return Yii::$app->assetManager->getAssetUrl($this, ltrim($path, '/'), true);
    }
}
