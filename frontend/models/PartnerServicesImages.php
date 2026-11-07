<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\models\query\PartnerServicesImagesQuery;
use frontend\models\query\PartnerServicesQuery;
use common\modules\content\models\PartnerServicesImages as CommonPartnerServicesImages;
use yii\db\ActiveQuery;

class PartnerServicesImages extends CommonPartnerServicesImages
{
    public function getPartnerServices(): ActiveQuery|PartnerServicesQuery
    {
        return $this->hasOne(PartnerServices::class, ['id' => 'partner_services_id']);
    }

    public static function find(): PartnerServicesImagesQuery
    {
        return new PartnerServicesImagesQuery(get_called_class());
    }
}
