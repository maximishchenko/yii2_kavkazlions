<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\DocumentsAttach as CommonDocumentsAttach;
use backend\modules\content\models\query\DocumentsAttachQuery;
use backend\traits\FileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

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
class DocumentsAttach extends CommonDocumentsAttach
{
    use FileTrait;

    /**
     * Загружаемый файл
     * 
     * @var mixed $attachFile
     */
    public $attachFile = null;

    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name'], 'unique'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Document Attach Name'),
            'attach' => Yii::t('app', 'Document Attach'),
            'attachFile' => Yii::t('app', 'Document Attach'),
            'description' => Yii::t('app', 'Document Description'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Document Name Hint'),
            'attach' => Yii::t('app', 'Document Attach Hint'),
            'description' => Yii::t('app', 'Document Description Hint'),
        ]);
    }

    public function getDocuments(): mixed
    {
        return $this->hasOne(Documents::class, ['id' => 'document_id']);
    }

    public static function find(): DocumentsAttachQuery
    {
        return new DocumentsAttachQuery(get_called_class());
    }
    
    
    public function beforeSave($insert): bool
    {
        if (parent::beforeSave($insert)) {
            
            if(!Yii::$app instanceof \yii\console\Application) {
                if (Yii::$app->request->isPost || Yii::$app->request->isPut) {

                    if ($this->validate()) {
                        $this->uploadFile('attachFile', 'attach', self::UPLOAD_PATH);
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
                $this->deleteSingleFile('attach', self::UPLOAD_PATH);
                return true;
            }
        } else {
            return false;
        }
    }

}
