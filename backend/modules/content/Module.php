<?php

declare(strict_types=1);

namespace backend\modules\content;

use yii\base\Module as BaseModule;
use yii\filters\AccessControl;

class Module extends BaseModule
{
    public $controllerNamespace = 'backend\modules\content\controllers';
    
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
}
