<?php

declare(strict_types=1);

namespace common\fixtures;

use yii\test\ActiveFixture;
use backend\modules\content\models\ManagementCompany;

class ManagementCompanyFixture extends ActiveFixture
{
    public $modelClass = ManagementCompany::class;
    public $dataFile = __DIR__ . '/data/management-company.php';
}