<?php

declare(strict_types=1);

use console\models\BaseMigration;

final class m261102_201607_create_management_tables extends BaseMigration
{
    public function safeUp()
    {        
        $this->createTable('{{%management_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'slug' => $this->string(),
            'sort' => $this->string(),
            'status' => $this->boolean(),
            'comment' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-management_category-id', '{{%management_category}}', 'id');
        $this->createIndex('idx-management_category-name', '{{%management_category}}', 'name');
        $this->createIndex('idx-management_category-image', '{{%management_category}}', 'image');
        $this->createIndex('idx-management_category-slug', '{{%management_category}}', 'slug');
        $this->createIndex('idx-management_category-sort', '{{%management_category}}', 'sort');
        $this->createIndex('idx-management_category-status', '{{%management_category}}', 'status');
        $this->createIndex('idx-management_category-created_at', '{{%management_category}}', 'created_at');
        $this->createIndex('idx-management_category-updated_at', '{{%management_category}}', 'updated_at');
        $this->createIndex('idx-management_category-created_by', '{{%management_category}}', 'created_by');
        $this->createIndex('idx-management_category-updated_by', '{{%management_category}}', 'updated_by');
    }

    public function safeDown()
    {
        $this->dropTable('{{%management_category}}');
    }
}
