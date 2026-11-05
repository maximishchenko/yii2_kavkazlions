<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use common\modules\content\models\Materials as CommonMaterials;
use backend\modules\content\models\query\MaterialsQuery;
use common\models\Sort;
use common\models\Status;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%materials}}".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $text
 * @property string|null $comment
 * @property string|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Materials extends CommonMaterials
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'text'], 'required'],
            [['name'], 'unique'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Material Name'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Material Name Hint'),
        ]);
    }
    
    public static function find(): MaterialsQuery | array | null
    {
        return new MaterialsQuery(get_called_class());
    }

}
