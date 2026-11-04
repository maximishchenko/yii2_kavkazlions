<?php

declare(strict_types=1);

namespace backend\models;

use backend\models\BaseCrudModel;
use yii\behaviors\SluggableBehavior;

abstract class BaseSluggableCrudModel extends BaseCrudModel
{
    public function behaviors(): array
    {
        $sluggable = [
                'class' => SluggableBehavior::class,
                'attribute' => ['name'],
                'slugAttribute' => 'slug',
                'immutable' => true,
                'ensureUnique'=>true,
            ];
        return array_merge(parent::behaviors(), [$sluggable]);
    } 
}