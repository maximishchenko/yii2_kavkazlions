<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\models\query\PartnerServicesQuery;
use yii\db\ActiveQuery;
use common\modules\content\models\PartnerServices as CommonPartnerServices;

/**
 * This is the model class for table "{{%partner_services}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $sort
 * @property int|null $status
 * @property string|null $comment
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property PartnerServicesImages[] $partnerServicesImages
 */
class PartnerServices extends CommonPartnerServices
{
    public function getPartnerServicesImages(): ActiveQuery
    {
        return $this
                ->hasMany(PartnerServicesImages::class, ['partner_services_id' => 'id'])
                ->orderBy([PartnerServicesImages::tableName() . '.sort' => SORT_ASC]);
    }

    public static function find(): PartnerServicesQuery | array | null
    {
        return (new PartnerServicesQuery(get_called_class()))->active();
    }
}
