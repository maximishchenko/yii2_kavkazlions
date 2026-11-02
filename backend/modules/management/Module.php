<?php

declare(strict_types=1);

namespace backend\modules\management;

use yii\base\Module as CoreModule;
use yii\filters\AccessControl;

final class Module extends CoreModule
{
    public $controllerNamespace = 'backend\modules\management\controllers';
    
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
