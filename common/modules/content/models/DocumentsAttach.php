<?php

declare(strict_types=1);

namespace common\modules\content\models;

use common\models\BaseCrudModel;
use Yii;

/**
 * This is the model class for table "{{%documents_attach}}".
 *
 * @property int $id
 * @property string $name
 * @property int $document_id
 * @property string $attach
 * @property int|null $sort
 * @property int|null $status
 * @property string|null $comment
 * @property string|null $description
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Documents $documents
 */
abstract class DocumentsAttach extends BaseCrudModel
{
    /**
     * Каталог для загрузки файлов вложений
     */
    const UPLOAD_PATH = 'uploads/documents-attach/';

    public static function tableName(): string
    {
        return '{{%documents_attach}}';
    }

    public function rules(): array
    {
        return [
            [['sort', 'status', 'comment', 'description', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['name', 'document_id'], 'required'],
            [['document_id', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['comment', 'description'], 'string'],
            [['name', 'attach'], 'string', 'max' => 255],
            [['document_id'], 'exist', 'skipOnError' => true, 'targetClass' => Documents::class, 'targetAttribute' => ['document_id' => 'id']],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'document_id' => Yii::t('app', 'Document ID'),
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
            'document_id' => Yii::t('app', 'Document ID Hint'),
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
