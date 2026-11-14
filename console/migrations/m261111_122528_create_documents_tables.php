<?php


declare(strict_types=1);

use console\models\BaseMigration;

final class m261111_122528_create_documents_tables extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%documents_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->defaultValue(0),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->boolean(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-documents_category-id', '{{%documents_category}}', 'id');
        $this->createIndex('idx-documents_category-parent_id', '{{%documents_category}}', 'parent_id');
        $this->createIndex('idx-documents_category-name', '{{%documents_category}}', 'name');
        $this->createIndex('idx-documents_category-slug', '{{%documents_category}}', 'slug');
        $this->createIndex('idx-documents_category-sort', '{{%documents_category}}', 'sort');
        $this->createIndex('idx-documents_category-status', '{{%documents_category}}', 'status');
        $this->createIndex('idx-documents_category-created_at', '{{%documents_category}}', 'created_at');
        $this->createIndex('idx-documents_category-updated_at', '{{%documents_category}}', 'updated_at');
        $this->createIndex('idx-documents_category-created_by', '{{%documents_category}}', 'created_by');
        $this->createIndex('idx-documents_category-updated_by', '{{%documents_category}}', 'updated_by');

        
        $this->createTable('{{%documents}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'slug' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->boolean(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-documents-id', '{{%documents}}', 'id');
        $this->createIndex('idx-documents-name', '{{%documents}}', 'name');
        $this->createIndex('idx-documents-category_id', '{{%documents}}', 'category_id');
        $this->createIndex('idx-documents-slug', '{{%documents}}', 'slug');
        $this->createIndex('idx-documents-sort', '{{%documents}}', 'sort');
        $this->createIndex('idx-documents-status', '{{%documents}}', 'status');
        $this->createIndex('idx-documents-created_at', '{{%documents}}', 'created_at');
        $this->createIndex('idx-documents-updated_at', '{{%documents}}', 'updated_at');
        $this->createIndex('idx-documents-created_by', '{{%documents}}', 'created_by');
        $this->createIndex('idx-documents-updated_by', '{{%documents}}', 'updated_by');
        
        $this->addForeignKey(
            'fk-documents-documents_category',
            '{{%documents}}',
            'category_id',
            '{{%documents_category}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
        
        $this->createTable('{{%documents_attach}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'document_id' => $this->integer()->notNull(),
            'attach' => $this->string()->notNull(),
            'sort' => $this->integer(),
            'status' => $this->boolean(),
            'comment' => $this->text(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-documents_attach-id', '{{%documents_attach}}', 'id');
        $this->createIndex('idx-documents_attach-name', '{{%documents_attach}}', 'name');
        $this->createIndex('idx-documents_attach-document_id', '{{%documents_attach}}', 'document_id');
        $this->createIndex('idx-documents_attach-sort', '{{%documents_attach}}', 'sort');
        $this->createIndex('idx-documents_attach-status', '{{%documents_attach}}', 'status');
        $this->createIndex('idx-documents_attach-created_at', '{{%documents_attach}}', 'created_at');
        $this->createIndex('idx-documents_attach-updated_at', '{{%documents_attach}}', 'updated_at');
        $this->createIndex('idx-documents_attach-created_by', '{{%documents_attach}}', 'created_by');
        $this->createIndex('idx-documents_attach-updated_by', '{{%documents_attach}}', 'updated_by');
        
        $this->addForeignKey(
            'fk-documents_attach-documents',
            '{{%documents_attach}}',
            'document_id',
            '{{%documents}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%documents_attach}}');
        $this->dropTable('{{%documents}}');
        $this->dropTable('{{%documents_category}}');
    }
}
