<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\DocumentsCategory;

class DocumentsCategoryFixture extends ActiveFixture
{
    public $modelClass = DocumentsCategory::class;
    public $dataFile = __DIR__ . '/data/documents-category.php';
}