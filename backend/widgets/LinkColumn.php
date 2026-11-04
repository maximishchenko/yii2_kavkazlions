<?php

declare(strict_types=1);

namespace backend\widgets;

use Closure;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;

final class LinkColumn extends DataColumn
{
    /**
     * @var callable
     */
    public $url;
    /**
     * @var bool
     */
    public bool $targetBlank = false;

    /**
     * @var string
     */
    public $controller;

    /**
     * @inheritdoc
     */
    public $format = 'raw';

    public string $action = 'update';

    protected function renderDataCellContent($model, $key, $index): string
    {
        $value = $this->getDataCellValue($model, $key, $index);
        $text = $this->grid->formatter->format($value, $this->format);
        $url = $this->createUrl($model, $key, $index);
        $options = $this->targetBlank ? ['target' => '_blank'] : [];
        return $value === null ? $this->grid->emptyCell : Html::a($text, $url, $options);
    }

    public function createUrl($model, $key, $index)
    {
        if ($this->url instanceof Closure) {
            return call_user_func($this->url, $model, $key, $index);
        } else {
            $params = is_array($key) ? $key : ['id' => (string) $key];
            $params[0] = $this->controller ? $this->controller . '/' . $this->action : $this->action;
            return Url::toRoute($params);
        }
    }
}