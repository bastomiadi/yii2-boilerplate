<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%genders}}`.
 */
class m240117_073236_create_genders_table extends Migration
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

        $this->createTable('{{%genders}}', [
            'id' => $this->bigPrimaryKey(),
            'gender_name' => $this->string()->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger()->notNull(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(false),
        ], $tableOptions);

        // Add foreign keys and indexes
        $this->addForeignKey('fk-genders-created_by', '{{%genders}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-genders-updated_by', '{{%genders}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-genders-deleted_by', '{{%genders}}', 'deleted_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-genders-created_by', '{{%genders}}', 'created_by');
        $this->createIndex('idx-genders-updated_by', '{{%genders}}', 'updated_by');
        $this->createIndex('idx-genders-deleted_by', '{{%genders}}', 'deleted_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys and indexes
        $this->dropForeignKey('fk-genders-created_by', '{{%genders}}');
        $this->dropForeignKey('fk-genders-updated_by', '{{%genders}}');
        $this->dropForeignKey('fk-genders-deleted_by', '{{%genders}}');

        $this->dropIndex('idx-genders-created_by', '{{%genders}}');
        $this->dropIndex('idx-genders-updated_by', '{{%genders}}');
        $this->dropIndex('idx-genders-deleted_by', '{{%genders}}');

        $this->dropTable('{{%genders}}');
    }
}
