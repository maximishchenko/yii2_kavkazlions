<?php

declare(strict_types=1);

namespace frontend\models\query;

use yii\db\ActiveQuery;
use common\models\Status;

abstract class BaseModelQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Status::STATUS_ACTIVE->value]);
    }

    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}
