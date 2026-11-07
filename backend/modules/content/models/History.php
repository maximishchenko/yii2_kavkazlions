<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\History as CommonHistory;
use backend\modules\content\models\query\HistoryQuery;
use backend\traits\FileTrait;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

class History extends CommonHistory
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
            [['name'], 'required'],
            [['name'], 'unique'],
            [['title'], 'unique'],
            [['description'], 'required'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
            [['imageFile'], 'image', 'skipOnEmpty' => true, 'extensions' => 'webp png jpg jpeg', 'maxSize' => 2 * 1024 * 1024],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'History Name'),
            'title' => Yii::t('app', 'History Title'),
            'imageFile' => Yii::t('app', 'History Image'),
            'description' => Yii::t('app', 'History Description'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'History Name Hint'),
            'title' => Yii::t('app', 'History Title Hint'),
            'imageFile' => Yii::t('app', 'History Image Hint'),
            'description' => Yii::t('app', 'History Description Hint'),
        ]);
    }

    public static function find(): HistoryQuery | array | null
    {
        return new HistoryQuery(get_called_class());
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
