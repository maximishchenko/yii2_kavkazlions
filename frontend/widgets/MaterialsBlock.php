<?php

declare(strict_types=1);

namespace frontend\widgets;

use backend\modules\content\models\Materials;
use yii\base\Widget;
use yii\helpers\HtmlPurifier;

final class MaterialsBlock extends Widget
{
    /**
     * Slug ЧПУ
     *
     * @var string | null $slug
     */
    public $slug;

    /**
     * Уникальный ID материала
     *
     * @var int | null $id
     */
    public $id;

    public function run(): string
    {
        $cond = $this->slug !== null
            ? ['slug' => $this->slug]
            : ['id' => $this->id];

        $material = Materials::findOne([$cond]);
        if (!$material) {
            return '';
        }

        return HtmlPurifier::process($material->text);
    }
}