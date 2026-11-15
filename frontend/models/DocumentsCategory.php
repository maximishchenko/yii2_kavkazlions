<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\models\query\DocumentsCategoryQuery;
use common\modules\content\models\DocumentsCategory as CommonDocumentsCategory;

class DocumentsCategory extends CommonDocumentsCategory
{
    /** @return array[] Links from the root category through this category. */
    public function getBreadcrumbLinks(): array
    {
        $links = [];
        $visited = [];
        $category = $this;

        while ($category !== null && !isset($visited[$category->id])) {
            $visited[$category->id] = true;
            $links[] = ['label' => $category->name, 'url' => ['/documents/category', 'slug' => $category->slug]];
            $category = $category->parent_id ? static::find()->andWhere(['id' => $category->parent_id])->one() : null;
        }

        return array_reverse($links);
    }

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
