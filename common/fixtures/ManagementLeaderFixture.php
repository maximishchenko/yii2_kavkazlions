<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\ManagementLeader;

class ManagementLeaderFixture extends ActiveFixture
{
    public $modelClass = ManagementLeader::class;
    public $dataFile = __DIR__ . '/data/management-leader.php';
}