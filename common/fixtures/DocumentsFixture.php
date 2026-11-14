<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\Documents;

class DocumentsFixture extends ActiveFixture
{
    public $modelClass = Documents::class;
    public $dataFile = __DIR__ . '/data/documents.php';
}