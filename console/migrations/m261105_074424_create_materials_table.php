<?php

declare(strict_types=1);

use console\models\BaseMigration;

final class m261105_074424_create_materials_table extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%materials}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'comment' => $this->text(),
            'sort' => $this->string(),
            'status' => $this->boolean(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-materials-id', '{{%materials}}', 'id');
        $this->createIndex('idx-materials-name', '{{%materials}}', 'name');
        $this->createIndex('idx-materials-slug', '{{%materials}}', 'slug');
        $this->createIndex('idx-materials-sort', '{{%materials}}', 'sort');
        $this->createIndex('idx-materials-status', '{{%materials}}', 'status');
        $this->createIndex('idx-materials-created_at', '{{%materials}}', 'created_at');
        $this->createIndex('idx-materials-updated_at', '{{%materials}}', 'updated_at');
        $this->createIndex('idx-materials-created_by', '{{%materials}}', 'created_by');
        $this->createIndex('idx-materials-updated_by', '{{%materials}}', 'updated_by');
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%materials}}');
    }
}
