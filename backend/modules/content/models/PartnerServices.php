<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\PartnerServicesQuery;
use backend\traits\FileTrait;
use common\models\Sort;
use common\models\Status;
use yii\db\ActiveQuery;
use common\modules\content\models\PartnerServices as CommonPartnerServices;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
    use FileTrait;

    /**
     * Поле для загрузки нескольких изображений
     * 
     * @var mixed $imagesFiles
     */
    public $imagesFiles;
    
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['imagesFiles'], 'safe'],
            [['description'], 'required'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            // [['imagesFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'webp', 'maxFiles' => 10, 'maxSize' => 2 * 1024 * 1024],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Partner Services Name'),
            'description' => Yii::t('app', 'Partner Services Description'),
            'imagesFiles' => Yii::t('app', 'Images Files'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Partner Services Name Hint'),
            'description' => Yii::t('app', 'Partner Services Description Hint'),
            'imagesFiles' => Yii::t('app', 'Images Files Hint'),
        ]);
    }

    public function getPartnerServicesImages(): ActiveQuery
    {
        return $this->hasMany(PartnerServicesImages::class, ['partner_services_id' => 'id'])->orderBy([PartnerServicesImages::tableName().'.sort' => SORT_ASC]);
    }

    public static function find(): PartnerServicesQuery | array | null
    {
        return new PartnerServicesQuery(get_called_class());
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->setPartnerServicesImages();
        parent::afterSave($insert, $changedAttributes);
    }

    public function beforeDelete(): bool
    {

        if (parent::beforeDelete()) {
            /**
             * Удаление связанных изображений
             */
            $this->deleteMultipleFiles('partnerServicesImages', 'image', PartnerServicesImages::UPLOAD_PATH);
            return true;
        } else {
            return false;
        }
    }

    private function setPartnerServicesImages()
    {
        $this->imagesFiles = UploadedFile::getInstances($this, 'imagesFiles');
        if(isset($this->imagesFiles) && !empty($this->imagesFiles))
        {
            foreach ($this->imagesFiles as $key=>$img) {
                $imageModel = new PartnerServicesImages();
                $imageModel->imageFile = $img;
                $imageModel->partner_services_id = $this->id;
                $imageModel->sort = $key;
                $imageModel->save();
                // print_r($imageModel->getErrors());
            }
        }
    }
}
