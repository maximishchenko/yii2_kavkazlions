<?php

declare(strict_types=1);

namespace common\modules\content\models;

use common\models\BaseSluggableCrudModel;
use Yii;

/**
 * This is the model class for table "{{%materials}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $text
 * @property string|null $comment
 * @property string|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
abstract class Materials extends BaseSluggableCrudModel
{
    public static function tableName(): string
    {
        return '{{%materials}}';
    }

    public function rules(): array
    {
        return [
            [['comment', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['name', 'slug', 'text'], 'required'],
            [['text', 'comment'], 'string'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'slug', 'sort'], 'string', 'max' => 255],
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
