<?php

declare(strict_types=1);

namespace frontend\models;

use common\models\Status;
use common\modules\content\models\DocumentsAttach as CommonDocumentsAttach;
use yii\db\ActiveQuery;

class DocumentsAttach extends CommonDocumentsAttach
{
    public static function find(): ActiveQuery
    {
        return parent::find()->andWhere(['status' => Status::STATUS_ACTIVE->value]);
    }
}
