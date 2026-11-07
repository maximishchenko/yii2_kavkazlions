<?php

declare(strict_types=1);

use console\models\BaseMigration;

class m261107_090534_create_history_table extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%history}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'title' => $this->string()->notNull(),
            'image' => $this->string(),
            'slug' => $this->string(),
            'sort' => $this->string(),
            'status' => $this->boolean(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());
        
        $this->createIndex('idx-history-id', '{{%history}}', 'id');
        $this->createIndex('idx-history-name', '{{%history}}', 'name');
        $this->createIndex('idx-history-image', '{{%history}}', 'image');
        $this->createIndex('idx-history-slug', '{{%history}}', 'slug');
        $this->createIndex('idx-history-sort', '{{%history}}', 'sort');
        $this->createIndex('idx-history-status', '{{%history}}', 'status');
        $this->createIndex('idx-history-created_at', '{{%history}}', 'created_at');
        $this->createIndex('idx-history-updated_at', '{{%history}}', 'updated_at');
        $this->createIndex('idx-history-created_by', '{{%history}}', 'created_by');
        $this->createIndex('idx-history-updated_by', '{{%history}}', 'updated_by');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%history}}');
    }
}
