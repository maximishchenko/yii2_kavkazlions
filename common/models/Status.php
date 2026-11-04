<?php

declare(strict_types=1);

namespace common\models;

use Yii;


enum Status: int {
    case STATUS_ACTIVE = 1;
    case STATUS_BLOCKED = 0;

    public static function getStatusesArray(): array
    {
        return [
            self::STATUS_ACTIVE->value => Yii::t('app', 'STATUS_ACTIVE'),
            self::STATUS_BLOCKED->value => Yii::t('app', 'STATUS_BLOCKED'),
        ];
    }

    public static function getValuesCssClasses(): array
    {
        return [
            self::STATUS_ACTIVE->value => "success",
            self::STATUS_BLOCKED->value => "danger",
        ];
    }
}