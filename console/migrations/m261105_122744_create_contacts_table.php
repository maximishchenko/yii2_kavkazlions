<?php

declare(strict_types=1);

use console\models\BaseMigration;

final class m261105_122744_create_contacts_table extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%contacts}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'address' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'latitude' => $this->float(),
            'longitude' => $this->float(),
            'text' => $this->text(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());
        
        $this->createIndex('idx-contacts-id', '{{%contacts}}', 'id');
        $this->createIndex('idx-contacts-name', '{{%contacts}}', 'name');
        $this->createIndex('idx-contacts-slug', '{{%contacts}}', 'slug');
        $this->createIndex('idx-contacts-address', '{{%contacts}}', 'address');
        $this->createIndex('idx-contacts-phone', '{{%contacts}}', 'phone');
        $this->createIndex('idx-contacts-email', '{{%contacts}}', 'email');
        $this->createIndex('idx-contacts-latitude', '{{%contacts}}', 'latitude');
        $this->createIndex('idx-contacts-longitude', '{{%contacts}}', 'longitude');
        $this->createIndex('idx-contacts-sort', '{{%contacts}}', 'sort');
        $this->createIndex('idx-contacts-status', '{{%contacts}}', 'status');
        $this->createIndex('idx-contacts-created_at', '{{%contacts}}', 'created_at');
        $this->createIndex('idx-contacts-updated_at', '{{%contacts}}', 'updated_at');
        $this->createIndex('idx-contacts-created_by', '{{%contacts}}', 'created_by');
        $this->createIndex('idx-contacts-updated_by', '{{%contacts}}', 'updated_by');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%contacts}}');
    }
}
