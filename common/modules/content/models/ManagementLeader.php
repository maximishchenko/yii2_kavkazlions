<?php

declare(strict_types=1);

namespace common\modules\content\models;

use common\models\BaseSluggableCrudModel;
use Yii;

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
abstract class ManagementLeader extends BaseSluggableCrudModel
{
    const UPLOAD_PATH = 'uploads/management-leaders/';

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
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'managementCompany' => Yii::t('app', 'Management Company ID'),
            'management_company_id' => Yii::t('app', 'Management Company ID'),
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
}
