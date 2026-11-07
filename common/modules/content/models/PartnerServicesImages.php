<?php

declare(strict_types=1);

namespace common\modules\content\models;

use common\models\BaseCrudModel;
use Yii;

/**
 * This is the model class for table "{{%partner_services_images}}".
 *
 * @property int $id
 * @property int $partner_services_id
 * @property string|null $image
 * @property string|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 */
abstract class PartnerServicesImages extends BaseCrudModel
{
    const UPLOAD_PATH = 'uploads/partner_services_images/';

    public static function tableName(): string
    {
        return '{{%partner_services_images}}';
    }

    public function rules(): array
    {
        return [
            [['image', 'sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['partner_services_id'], 'required'],
            [['partner_services_id', 'sort', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['partner_services_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartnerServices::class, 'targetAttribute' => ['partner_services_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'partner_services_id' => Yii::t('app', 'Partner Services ID'),
            'image' => Yii::t('app', 'Image'),
            'sort' => Yii::t('app', 'Sort'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
