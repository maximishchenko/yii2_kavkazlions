<?php

declare(strict_types=1);

use console\models\BaseMigration;

final class m261102_201607_create_management_tables extends BaseMigration
{
    public function safeUp()
    {        
        $this->createTable('{{%management_company}}', [
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

        $this->createIndex('idx-management_company-id', '{{%management_company}}', 'id');
        $this->createIndex('idx-management_company-name', '{{%management_company}}', 'name');
        $this->createIndex('idx-management_company-image', '{{%management_company}}', 'image');
        $this->createIndex('idx-management_company-slug', '{{%management_company}}', 'slug');
        $this->createIndex('idx-management_company-sort', '{{%management_company}}', 'sort');
        $this->createIndex('idx-management_company-status', '{{%management_company}}', 'status');
        $this->createIndex('idx-management_company-created_at', '{{%management_company}}', 'created_at');
        $this->createIndex('idx-management_company-updated_at', '{{%management_company}}', 'updated_at');
        $this->createIndex('idx-management_company-created_by', '{{%management_company}}', 'created_by');
        $this->createIndex('idx-management_company-updated_by', '{{%management_company}}', 'updated_by');
    }

    public function safeDown()
    {
        $this->dropTable('{{%management_company}}');
    }
}
