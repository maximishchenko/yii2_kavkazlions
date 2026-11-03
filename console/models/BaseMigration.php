<?php

declare(strict_types=1);


namespace console\models;

use yii\db\Migration;

abstract class BaseMigration extends Migration
{
    const MYSQL_DRIVER_NAME = 'mysql';
    const MYSQL_TABLE_OPTIONS = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
    
    protected function getTableOptions(): string
    {
        return ($this->db->driverName === self::MYSQL_DRIVER_NAME) ? self::MYSQL_TABLE_OPTIONS : null;
    }
}