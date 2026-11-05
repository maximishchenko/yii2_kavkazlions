<?php

declare(strict_types=1);

namespace common\modules\content\models;

use common\models\BaseSluggableCrudModel;
use Yii;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $text
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
abstract class Contacts extends BaseSluggableCrudModel
{
    public static function tableName(): string
    {
        return '{{%contacts}}';
    }

    public function rules(): array
    {
        return [
            [['slug', 'address', 'phone', 'email', 'latitude', 'longitude', 'comment', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['name'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['text', 'comment'], 'string'],
            [['sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'address', 'phone', 'email'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'slug' => Yii::t('app', 'Slug'),
            'text' => Yii::t('app', 'Text'),
            'comment' => Yii::t('app', 'Comment'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
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
            'slug' => Yii::t('app', 'Slug Hint'),
            'text' => Yii::t('app', 'Text Hint'),
            'comment' => Yii::t('app', 'Comment Hint'),
            'sort' => Yii::t('app', 'Sort Hint'),
            'status' => Yii::t('app', 'Status Hint'),
            'created_at' => Yii::t('app', 'Created At Hint'),
            'updated_at' => Yii::t('app', 'Updated At Hint'),
            'created_by' => Yii::t('app', 'Created By Hint'),
            'updated_by' => Yii::t('app', 'Updated By Hint'),
        ];
    }
}
