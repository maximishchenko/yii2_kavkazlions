<?php

declare(strict_types=1);

namespace common\models;

enum Sort: int {
    case DEFAULT_SORT_VALUE = 500;
    
    public static function getBackendDefaultSort(): array
    {
        return ['id'=>SORT_DESC];
    }
    
    public static function getFrontendDefaultSort(): array
    {
        return ['sort'=>SORT_ASC];
    }
}