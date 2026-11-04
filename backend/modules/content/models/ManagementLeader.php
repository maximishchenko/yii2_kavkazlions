<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\traits\FileTrait;
use backend\modules\content\models\query\ManagementLeaderQuery;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%management_leader}}".
 *
 * @property int $id
 * @property int $management_company_id
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
 *
 * @property ManagementCompany $managementCompany
 */
class ManagementLeader extends \backend\models\BaseSluggableCrudModel
{
    use FileTrait;

    const UPLOAD_PATH = 'uploads/management-leaders/';
    /**
     * Объект изображения логотипа для загрузки.
     *
     * @var mixed | null $imageFile
     */
    public $imageFile = null;

    public static function tableName(): string
    {
        return '{{%management_leader}}';
    }

    public function rules(): array
    {
        return [
            [['image', 'slug', 'sort', 'status', 'comment', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['management_company_id', 'name', 'title'], 'required'],
            [['management_company_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['comment'], 'string'],
            [['name', 'image', 'slug', 'sort'], 'string', 'max' => 255],
            [['description'], 'safe'],
            [['management_company_id'], 'exist', 'skipOnError' => true, 'targetClass' => ManagementCompany::class, 'targetAttribute' => ['management_company_id' => 'id']],
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
            'managementCompany' => Yii::t('app', 'Management Company ID'),
            'management_company_id' => Yii::t('app', 'Management Company ID'),
            'title' => Yii::t('app', 'Management Leader Title'),
            'description' => Yii::t('app', 'Management Leader Description'),
            'name' => Yii::t('app', 'Management Leader Name'),
            'image' => Yii::t('app', 'Management Leader Image'),
            'imageFile' => Yii::t('app', 'Management Leader Image'),
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
            'management_company_id' => Yii::t('app', 'Management Company ID Hint'),
            'name' => Yii::t('app', 'Management Leader Name Hint'),
            'title' => Yii::t('app', 'Management Leader Title Hint'),
            'description' => Yii::t('app', 'Management Leader Description Hint'),
            'image' => Yii::t('app', 'Management Leader Image Hint'),
            'imageFile' => Yii::t('app', 'Management Leader Image Hint'),
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

    public function getCompaniesItems()
    {
        $companies = ManagementCompany::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($companies,'id','name');
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
