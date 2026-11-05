<?php

declare(strict_types=1);

use console\models\BaseMigration;

final class m261105_183657_create_partners_table extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%partners}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());
        
        $this->createIndex('idx-partners-id', '{{%partners}}', 'id');
        $this->createIndex('idx-partners-name', '{{%partners}}', 'name');
        $this->createIndex('idx-partners-slug', '{{%partners}}', 'slug');
        $this->createIndex('idx-partners-sort', '{{%partners}}', 'sort');
        $this->createIndex('idx-partners-status', '{{%partners}}', 'status');
        $this->createIndex('idx-partners-created_at', '{{%partners}}', 'created_at');
        $this->createIndex('idx-partners-updated_at', '{{%partners}}', 'updated_at');
        $this->createIndex('idx-partners-created_by', '{{%partners}}', 'created_by');
        $this->createIndex('idx-partners-updated_by', '{{%partners}}', 'updated_by');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%partners}}');
    }
}
