<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\models\query\DocumentsCategoryQuery;
use common\modules\content\models\DocumentsCategory as CommonDocumentsCategory;

class DocumentsCategory extends CommonDocumentsCategory
{
    // public function getDocuments(): ActiveQuery|DocumentsQuery
    // {
    //     return $this->hasMany(Documents::class, ['category_id' => 'id']);
    // }

    // public function getChilds(): ActiveQuery|DocumentsCategoryQuery
    // {
    //     return $this->hasMany(self::class, ['parent_id' => 'id']);
    // }

    public static function find(): DocumentsCategoryQuery
    {
        return (new DocumentsCategoryQuery(get_called_class()))->active();
    }
}
