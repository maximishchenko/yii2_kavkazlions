<?php

declare(strict_types=1);

namespace backend\models;

use Yii;

final class Tabs
{  
    public static function isActionActive(array $actArray): string
    {
        $action = Yii::$app->controller->action->id;
        foreach ($actArray as $act) {
            if ($act == $action) {
                return 'nav-link active';
            }
        }
        return 'nav-link';
    }
}