<?php

declare(strict_types=1);

namespace frontend\models;

use frontend\models\query\ContactsQuery;
use common\modules\content\models\Contacts as CommonContacts;

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
    public static function find(): ContactsQuery | array | null
    {
        return (new ContactsQuery(get_called_class()))->active();
    }
}
