<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\ManagementCompany as CommonManagementCompany;
use backend\modules\content\models\query\ManagementCompanyQuery;
use backend\traits\FileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

class ManagementCompany extends CommonManagementCompany
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
            [['name'], 'unique'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'webp png jpg jpeg', 'maxSize' => 2 * 1024 * 1024],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Management Company Name'),
            'image' => Yii::t('app', 'Management Company Image'),
            'imageFile' => Yii::t('app', 'Management Company Image'),
            'managementLeadersCount' => Yii::t('app', 'Management Leaders Count'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Management Company Name Hint'),
            'image' => Yii::t('app', 'Management Company Image Hint'),
            'imageFile' => Yii::t('app', 'Management Company Image Hint'),
        ]);
    }

    public static function find(): ManagementCompanyQuery|array|null
    {
        return new ManagementCompanyQuery(get_called_class());
    }   

    /**
     * Связь с руководителями управляющей компании
     *
     * @return \yii\db\ActiveQuery
     */
    public function getManagementLeaders()
    {
        return $this->hasMany(ManagementLeader::class, ['management_company_id' => 'id']);
    }

    /**
     * Возвращает количество руководителей управляющей компании
     *
     * @return int
     */
    public function getManagementLeadersCount(): int
    {
        return (int)$this->getManagementLeaders()->count();
    } 

    /**
     * Проверка наличия связанных записей в модели ManagementLeaders
     * Используется перед удалением организации.
     * В случае наличия записей - возвращает ошибку
     *
     * @return bool
     */
    private function validateLeadersBeforeDelete(): bool
    {
        if (!empty($this->managementLeaders)) {
            $this->addError('managementLeaders', Yii::t('app', 'Company has relation and cannot be deleted'));
            return false;
        }
        return true;
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
        /**
         * Проверка наличия связанных записей
         */
        $this->validateLeadersBeforeDelete();

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
