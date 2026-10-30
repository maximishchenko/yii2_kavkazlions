<?php

declare(strict_types=1);

namespace frontend\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\web\View;
use frontend\themes\v1\assets\ThemesAsset;

class ThemeManager extends Component
{
    /**
     * Менеджер ресурсов 
     *
     * @var \frontend\assets\BaseAssetBundle $_bundle
     */
    private $_bundle;

    public function getBundle()
    {
        if ($this->_bundle === null) {
            $view = Yii::$app->view;
            if (!$view instanceof View) {
                throw new InvalidConfigException('The "view" component must be an instance of ' . View::class . '.');
            }
            $this->_bundle = ThemesAsset::register($view);
        }
        return $this->_bundle;
    }

    public function getBaseUrl()
    {
        return $this->getBundle()->baseUrl;
    }

    public function getBasePath()
    {
        return $this->getBundle()->basePath;
    }
}