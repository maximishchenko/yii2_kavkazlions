<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\History;

class HistoryFixture extends ActiveFixture
{
    public $modelClass = History::class;
    public $dataFile = __DIR__ . '/data/history.php';
}