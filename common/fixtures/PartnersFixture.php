<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\Partners;

class PartnersFixture extends ActiveFixture
{
    public $modelClass = Partners::class;
    public $dataFile = __DIR__ . '/data/partners.php';
}