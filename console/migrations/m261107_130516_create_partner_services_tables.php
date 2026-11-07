<?php

declare(strict_types=1);

use console\models\BaseMigration;

class m261107_130516_create_partner_services_tables extends BaseMigration
{
    public function safeUp(): void
    {
        $this->createTable('{{%partner_services}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
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
        
        $this->createIndex('idx-partner_services-id', '{{%partner_services}}', 'id');
        $this->createIndex('idx-partner_services-name', '{{%partner_services}}', 'name');
        $this->createIndex('idx-partner_services-slug', '{{%partner_services}}', 'slug');
        $this->createIndex('idx-partner_services-sort', '{{%partner_services}}', 'sort');
        $this->createIndex('idx-partner_services-status', '{{%partner_services}}', 'status');
        $this->createIndex('idx-partner_services-created_at', '{{%partner_services}}', 'created_at');
        $this->createIndex('idx-partner_services-updated_at', '{{%partner_services}}', 'updated_at');
        $this->createIndex('idx-partner_services-created_by', '{{%partner_services}}', 'created_by');
        $this->createIndex('idx-partner_services-updated_by', '{{%partner_services}}', 'updated_by');


        $this->createTable('{{%partner_services_images}}', [
            'id' => $this->primaryKey(),
            'partner_services_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'sort' => $this->string(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $this->getTableOptions());

        $this->createIndex('idx-partner_services_images-id', '{{%partner_services_images}}', 'id');
        $this->createIndex('idx-partner_services_images-partner_services_id', '{{%partner_services_images}}', 'partner_services_id');
        $this->createIndex('idx-partner_services_images-image', '{{%partner_services_images}}', 'image');
        $this->createIndex('idx-partner_services_images-sort', '{{%partner_services_images}}', 'sort');
        $this->createIndex('idx-partner_services_images-created_at', '{{%partner_services_images}}', 'created_at');
        $this->createIndex('idx-partner_services_images-updated_at', '{{%partner_services_images}}', 'updated_at');
        $this->createIndex('idx-partner_services_images-created_by', '{{%partner_services_images}}', 'created_by');
        $this->createIndex('idx-partner_services_images-updated_by', '{{%partner_services_images}}', 'updated_by');
        
        $this->addForeignKey(
            'fk-partner_services_images-partner_services',
            '{{%partner_services_images}}',
            'partner_services_id',
            '{{%partner_services}}',
            'id',
            'CASCADE',
            'RESTRICT'
        );

    }

    public function safeDown(): void
    {
        $this->dropTable('{{%partner_services_images}}');
        $this->dropTable('{{%partner_services}}');
    }
}
