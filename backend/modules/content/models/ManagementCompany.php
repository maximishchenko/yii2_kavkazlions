<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\models\BaseSluggableCrudModel;
use backend\models\User;
use backend\modules\content\models\query\ManagementCompanyQuery;
use backend\traits\FileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;

/**
 * This is the model class for table "{{%management_company}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $image
 * @property string|null $slug
 * @property string|null $sort
 * @property int|null $status
 * @property string|null $comment
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class ManagementCompany extends BaseSluggableCrudModel
{
    use FileTrait;

    const UPLOAD_PATH = 'uploads/management-companies/';

    /**
     * Объект изображения логотипа для загрузки.
     *
     * @var mixed | null $imageFile
     */
    public $imageFile = null;

    public static function tableName(): string
    {
        return '{{%management_company}}';
    }

    public function rules(): array
    {
        return [
            [['image', 'slug', 'sort', 'status', 'comment', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['name'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['comment'], 'string'],
            [['name', 'image', 'slug', 'sort'], 'string', 'max' => 255],

            [['name'], 'unique'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'webp png jpg jpeg', 'maxSize' => 2 * 1024 * 1024],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Management Company Name'),
            'image' => Yii::t('app', 'Management Company Image'),
            'imageFile' => Yii::t('app', 'Management Company Image'),
            'managementLeadersCount' => Yii::t('app', 'Management Leaders Count'),
            'slug' => Yii::t('app', 'Slug'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'comment' => Yii::t('app', 'Comment'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    public function attributeHints(): array
    {
        return [
            'id' => Yii::t('app', 'ID Hint'),
            'name' => Yii::t('app', 'Management Company Name Hint'),
            'image' => Yii::t('app', 'Management Company Image Hint'),
            'imageFile' => Yii::t('app', 'Management Company Image Hint'),
            'slug' => Yii::t('app', 'Slug Hint'),
            'sort' => Yii::t('app', 'Sort Hint'),
            'status' => Yii::t('app', 'Status Hint'),
            'comment' => Yii::t('app', 'Comment Hint'),
            'created_at' => Yii::t('app', 'Created At Hint'),
            'updated_at' => Yii::t('app', 'Updated At Hint'),
            'created_by' => Yii::t('app', 'Created By Hint'),
            'updated_by' => Yii::t('app', 'Updated By Hint'),
        ];
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

    public static function find(): ManagementCompanyQuery|array|null
    {
        return new ManagementCompanyQuery(get_called_class());
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
