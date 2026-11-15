<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\Documents as CommonDocuments;
use backend\modules\content\models\DocumentsCategory;
use backend\modules\content\models\query\DocumentsCategoryQuery;
use backend\modules\content\models\query\DocumentsQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

class Documents extends CommonDocuments
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocumentsCategory::class, 'targetAttribute' => ['category_id' => 'id']],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Documents Name'),
            'category_id' => Yii::t('app', 'Documents Category ID'),
            'description' => Yii::t('app', 'Documents Description'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Documents Name Hint'),
            'category_id' => Yii::t('app', 'Documents Category ID Hint'),
            'description' => Yii::t('app', 'Documents Description Hint'),
        ]);
    }

    public function getDocumentsCategory(): ActiveQuery|DocumentsCategoryQuery
    {
        return $this->hasOne(DocumentsCategory::class, ['id' => 'category_id']);
    }

    public static function find(): DocumentsQuery
    {
        return new DocumentsQuery(get_called_class());
    }

    public function getCategoriesItems()
    {
        $companies = DocumentsCategory::find()->orderBy(['name' => SORT_ASC])->all();
        return ArrayHelper::map($companies,'id','name');
    }
}
