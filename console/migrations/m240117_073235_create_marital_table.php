<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%marital}}`.
 */
class m240117_073235_create_marital_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // MySQL specific table options
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%marital}}', [
            'id' => $this->bigPrimaryKey(),
            'marital_name' => $this->string()->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger()->notNull(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // Add foreign keys and indexes
        $this->addForeignKey('fk-marital-created_by', '{{%marital}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-marital-updated_by', '{{%marital}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-marital-deleted_by', '{{%marital}}', 'deleted_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-marital-created_by', '{{%marital}}', 'created_by');
        $this->createIndex('idx-marital-updated_by', '{{%marital}}', 'updated_by');
        $this->createIndex('idx-marital-deleted_by', '{{%marital}}', 'deleted_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys and indexes
        $this->dropForeignKey('fk-marital-created_by', '{{%marital}}');
        $this->dropForeignKey('fk-marital-updated_by', '{{%marital}}');
        $this->dropForeignKey('fk-marital-deleted_by', '{{%marital}}');

        $this->dropIndex('idx-marital-created_by', '{{%marital}}');
        $this->dropIndex('idx-marital-updated_by', '{{%marital}}');
        $this->dropIndex('idx-marital-deleted_by', '{{%marital}}');

        $this->dropTable('{{%marital}}');
    }
}
