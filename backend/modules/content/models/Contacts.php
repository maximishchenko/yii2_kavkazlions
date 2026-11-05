<?php

declare(strict_types=1);

namespace backend\modules\content\models;

use backend\modules\content\models\query\ContactsQuery;
use common\models\Sort;
use common\models\Status;
use common\modules\content\models\Contacts as CommonContacts;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%contacts}}".
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $address
 * @property string|null $phone
 * @property string|null $email
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string $text
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class Contacts extends CommonContacts
{
    public function rules(): array
    {
        return ArrayHelper::merge(parent::rules(), [
            [['name', 'address'], 'unique'],
            [['email'], 'email'],
            ['status', 'in', 'range' => array_keys(Status::getStatusesArray())],
            [['sort'], 'default', 'value'=> Sort::DEFAULT_SORT_VALUE->value],
            [['status'], 'default', 'value'=> Status::STATUS_BLOCKED->value],
        ]);
    }

    public function attributeLabels(): array
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'name' => Yii::t('app', 'Contacts Name'),
            'address' => Yii::t('app', 'Contacts Address'),
            'phone' => Yii::t('app', 'Contacts Phone'),
            'email' => Yii::t('app', 'Contacts Email'),
            'latitude' => Yii::t('app', 'Contacts Latitude'),
            'longitude' => Yii::t('app', 'Contacts Longitude'),
        ]);
    }

    public function attributeHints(): array
    {
        return ArrayHelper::merge(parent::attributeHints(), [
            'name' => Yii::t('app', 'Contacts Name Hint'),
            'address' => Yii::t('app', 'Contacts Address Hint'),
            'phone' => Yii::t('app', 'Contacts Phone Hint'),
            'email' => Yii::t('app', 'Contacts Email Hint'),
            'latitude' => Yii::t('app', 'Contacts Latitude Hint'),
            'longitude' => Yii::t('app', 'Contacts Longitude Hint'),
        ]);
    }

    public static function find(): ContactsQuery | array | null
    {
        return new ContactsQuery(get_called_class());
    }

}
