<?php

declare(strict_types=1);

namespace frontend\models;

use common\modules\content\models\Partners as CommonPartners;
use frontend\models\query\PartnersQuery;
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

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Partner Name Hint'),
        ]);
    }

    public static function find(): PartnersQuery | array | null
    {
        return (new PartnersQuery(get_called_class()))->active();
    }

}
