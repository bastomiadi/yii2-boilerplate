<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%students}}`.
 */
class m240114_121704_create_students_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%students}}', [
            'id' => $this->bigPrimaryKey(),
            'sections' => $this->bigInteger()->notNull(),
            'classes' => $this->bigInteger()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'phone_number' => $this->string(20)->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
        ], $tableOptions);

         // add foreign key for table `sections`
         $this->addForeignKey(
            '{{%fk-students-sections}}',
            '{{%students}}',
            'sections',
            '{{%sections}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `classes`
        $this->addForeignKey(
            '{{%fk-students-classes}}',
            '{{%students}}',
            'classes',
            '{{%classes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

         // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-created_by}}',
            '{{%students}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-updated_by}}',
            '{{%students}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-deleted_by}}',
            '{{%students}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create index for column `sections`
        $this->createIndex(
            '{{%idx-students-sections}}',
            '{{%sections}}',
            'id'
        );

        // create index for column `classes`
         $this->createIndex(
            '{{%idx-students-classes}}',
            '{{%classes}}',
            'id'
        );

        // create index for column `created_by`
        $this->createIndex(
            '{{%idx-students-created_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `updated_by`
        $this->createIndex(
            '{{%idx-students-updated_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `deleted_by`
        $this->createIndex(
            '{{%idx-students-deleted_by}}',
            '{{%user}}',
            'id'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%students}}');
    }
}
