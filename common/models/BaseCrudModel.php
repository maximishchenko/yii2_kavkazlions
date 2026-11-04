<?php

declare(strict_types=1);

namespace common\models;

use common\modules\management\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

abstract class BaseCrudModel extends ActiveRecord
{
    public function behaviors(): array
    {
        return[
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => function () {
                    return date('U');
                },
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    } 

    /**
     * Связь с моделью пользователей по полю created_at
     *
     * @return mixed
     */
    public function getCreatedByUser(): mixed
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Связь с моделью пользователей по полю updated_at
     *
     * @return mixed
     */
    public function getUpdatedByUser(): mixed
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}