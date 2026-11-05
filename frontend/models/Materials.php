<?php

declare(strict_types=1);

namespace frontend\models;

use common\modules\content\models\Materials as CommonMaterials;
use frontend\models\query\MaterialsQuery;

class Materials extends CommonMaterials
{
    public static function find(): MaterialsQuery | array | null
    {
        return (new MaterialsQuery(get_called_class()))->active();
    }

}