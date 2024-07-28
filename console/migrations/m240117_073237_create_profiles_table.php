<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profiles}}`.
 */
class m240117_073237_create_profiles_table extends Migration
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

        $this->createTable('{{%profiles}}', [
            'id' => $this->bigPrimaryKey(),
            'user' => $this->bigInteger()->notNull(),
            'first_name' => $this->string(255)->notNull(),
            'last_name' => $this->string(255),
            'phone_number' => $this->string(20),
            'address' => $this->text(),
            'gender' => $this->bigInteger()->null(),
            'marital' => $this->bigInteger()->null(),
            'profile_image' => $this->string(255),
            'date_of_birth' => $this->date(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        // Add foreign keys and indexes
        $this->addForeignKey('fk-profiles-user', '{{%profiles}}', 'user', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profiles-gender', '{{%profiles}}', 'gender', '{{%genders}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profiles-marital', '{{%profiles}}', 'marital', '{{%marital}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profiles-created_by', '{{%profiles}}', 'created_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profiles-updated_by', '{{%profiles}}', 'updated_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-profiles-deleted_by', '{{%profiles}}', 'deleted_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->createIndex('idx-profiles-created_by', '{{%profiles}}', 'created_by');
        $this->createIndex('idx-profiles-updated_by', '{{%profiles}}', 'updated_by');
        $this->createIndex('idx-profiles-deleted_by', '{{%profiles}}', 'deleted_by');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys and indexes
        $this->dropForeignKey('fk-profiles-user', '{{%profiles}}');
        $this->dropForeignKey('fk-profiles-gender', '{{%profiles}}');
        $this->dropForeignKey('fk-profiles-marital', '{{%profiles}}');
        $this->dropForeignKey('fk-profiles-created_by', '{{%profiles}}');
        $this->dropForeignKey('fk-profiles-updated_by', '{{%profiles}}');
        $this->dropForeignKey('fk-profiles-deleted_by', '{{%profiles}}');

        $this->dropIndex('idx-profiles-created_by', '{{%profiles}}');
        $this->dropIndex('idx-profiles-updated_by', '{{%profiles}}');
        $this->dropIndex('idx-profiles-deleted_by', '{{%profiles}}');

        $this->dropTable('{{%profiles}}');
    }
}
