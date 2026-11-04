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
        
        $this->createTable('{{%management_leader}}', [
            'id' => $this->primaryKey(),
            'management_company_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'title' => $this->string(),
            'description' => $this->text(),
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

        $this->createIndex('idx-management_leader-id', '{{%management_leader}}', 'id');
        $this->createIndex('idx-management_leader-management_company_id', '{{%management_leader}}', 'management_company_id');
        $this->createIndex('idx-management_leader-name', '{{%management_leader}}', 'name');
        $this->createIndex('idx-management_leader-title', '{{%management_leader}}', 'title');
        $this->createIndex('idx-management_leader-image', '{{%management_leader}}', 'image');
        $this->createIndex('idx-management_leader-slug', '{{%management_leader}}', 'slug');
        $this->createIndex('idx-management_leader-sort', '{{%management_leader}}', 'sort');
        $this->createIndex('idx-management_leader-status', '{{%management_leader}}', 'status');
        $this->createIndex('idx-management_leader-created_at', '{{%management_leader}}', 'created_at');
        $this->createIndex('idx-management_leader-updated_at', '{{%management_leader}}', 'updated_at');
        $this->createIndex('idx-management_leader-created_by', '{{%management_leader}}', 'created_by');
        $this->createIndex('idx-management_leader-updated_by', '{{%management_leader}}', 'updated_by');
        
        $this->addForeignKey(
            'fk-management_leader-management_company',
            '{{%management_leader}}',
            'management_company_id',
            '{{%management_company}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function safeDown()
    {
        $this->dropTable('{{%management_leader}}');
        $this->dropTable('{{%management_company}}');
    }
}
