<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\traits\FileTrait;
use common\modules\content\models\ManagementLeader as CommonManagementLeader;
use backend\modules\content\models\query\ManagementLeaderQuery;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

class ManagementLeader extends CommonManagementLeader
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
        return ArrayHelper::merge(parent::rules(), [
            [['management_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => ManagementCompany::class, 'targetAttribute' => ['management_company_id' => 'id']],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'webp png jpg jpeg', 'maxSize' => 2 * 1024 * 1024],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'management_company_id' => Yii::t('app', 'Management Company ID'),
            'title' => Yii::t('app', 'Management Leader Title'),
            'description' => Yii::t('app', 'Management Leader Description'),
            'name' => Yii::t('app', 'Management Leader Name'),
            'image' => Yii::t('app', 'Management Leader Image'),
            'imageFile' => Yii::t('app', 'Management Leader Image'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'management_company_id' => Yii::t('app', 'Management Company ID Hint'),
            'title' => Yii::t('app', 'Management Leader Title Hint'),
            'description' => Yii::t('app', 'Management Leader Description Hint'),
            'name' => Yii::t('app', 'Management Leader Name Hint'),
            'image' => Yii::t('app', 'Management Leader Image Hint'),
            'imageFile' => Yii::t('app', 'Management Leader Image Hint'),
        ]);
    }

    /**
     * Gets query for [[ManagementCompany]].
     *
     * @return \yii\db\ActiveQuery|\backend\modules\content\models\query\ManagementCompanyQuery
     */
    public function getManagementCompany()
    {
        return $this->hasOne(ManagementCompany::class, ['id' => 'management_company_id']);
    }

    public function getCompaniesItems()
    {
        $companies = ManagementCompany::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($companies,'id','name');
    }

    public static function find(): ManagementLeaderQuery
    {
        return new ManagementLeaderQuery(get_called_class());
    }
    
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            
            if(!Yii::$app instanceof \yii\console\Application) {
                if (Yii::$app->request->isPost || Yii::$app->request->isPut) {

                    if ($this->validate()) {
                        $this->uploadFile('imageFile', 'image', self::UPLOAD_PATH);
                    } else {
                        foreach ($this->getErrors() as $key => $value) {
                            Yii::debug($key.': '.$value[0]);
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }
    
    public function beforeDelete(): bool
    {
        if (parent::beforeDelete()) {
            if ($this->hasErrors()) {
                return false;
            } else {
                $this->deleteSingleFile('image', self::UPLOAD_PATH);
                return true;
            }
        } else {
            return false;
        }
    }

}
