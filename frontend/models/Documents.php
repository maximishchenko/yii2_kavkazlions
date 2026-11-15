<?php

declare(strict_types=1);

namespace frontend\models;

use common\modules\content\models\Documents as CommonDocuments;
use frontend\models\query\DocumentsQuery;
use yii\db\ActiveQuery;

class Documents extends CommonDocuments
{
    public function getAttachments(): ActiveQuery
    {
        return $this->hasMany(DocumentsAttach::class, ['document_id' => 'id'])
            ->orderBy(['sort' => SORT_ASC, 'id' => SORT_ASC]);
    }

    // public function getDocumentsCategory(): ActiveQuery|DocumentsCategoryQuery
    // {
    //     return $this->hasOne(DocumentsCategory::class, ['id' => 'category_id']);
    // }

    public static function find(): DocumentsQuery
    {
        return (new DocumentsQuery(get_called_class()))->active();
    }

    // public function getCategoriesItems()
    // {
    //     $companies = DocumentsCategory::find()->orderBy(['name' => SORT_ASC])->all();
    //     return ArrayHelper::map($companies,'id','name');
    // }
}
