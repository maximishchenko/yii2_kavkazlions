<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\Partners as CommonPartners;
use backend\modules\content\models\query\PartnersQuery;
use Override;
use Yii;
use yii\helpers\ArrayHelper;

class Partners extends CommonPartners
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [

        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Partner Name'),
        ]);
    }

    #[Override]
    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Partner Name Hint'),
        ]);
    }

    public static function find(): PartnersQuery | array | null
    {
        return new PartnersQuery(get_called_class());
    }

}
