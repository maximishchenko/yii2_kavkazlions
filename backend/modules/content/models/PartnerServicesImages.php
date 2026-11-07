<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\PartnerServicesQuery;
use backend\traits\FileTrait;
use common\modules\content\models\PartnerServicesImages as CommonPartnerServicesImages;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class PartnerServicesImages extends CommonPartnerServicesImages
{
    use FileTrait;

    /**
     * Объект изображения логотипа для загрузки.
     *
     * @var mixed | null $imageFile
     */
    public $imageFile = null;
    
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), []);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), []);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), []);
    }

    public function getPartnerServices(): ActiveQuery|PartnerServicesQuery
    {
        return $this->hasOne(PartnerServices::class, ['id' => 'partner_services_id']);
    }

    public static function find(): PartnerServicesQuery
    {
        return new PartnerServicesQuery(get_called_class());
    }


    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            $this->uploadFile("imageFile", "image", self::UPLOAD_PATH, true);
            return true;
        }
        return false;
    }

    public function beforeDelete(): bool
    {

        if (parent::beforeDelete()) {
            
            /**
             * Удаление файла изображения
             */
            $this->deleteSingleFile('image', self::UPLOAD_PATH);
            
            return true;
        } else {
            return false;
        }
    }
}
