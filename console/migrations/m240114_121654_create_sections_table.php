<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sections}}`.
 */
class m240114_121654_create_sections_table extends Migration
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

        $this->createTable('{{%sections}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull(),
            'classes' => $this->bigInteger()->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ],$tableOptions);

         // add foreign key for table `classes`
         $this->addForeignKey(
            '{{%fk-sections-classes}}',
            '{{%sections}}',
            'classes',
            '{{%classes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

         // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-created_by}}',
            '{{%sections}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-updated_by}}',
            '{{%sections}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-deleted_by}}',
            '{{%sections}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create index for column `classes`
        $this->createIndex(
            '{{%idx-sections-classes}}',
            '{{%classes}}',
            'id'
        );

        // create index for column `created_by`
        $this->createIndex(
            '{{%idx-sections-created_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `updated_by`
        $this->createIndex(
            '{{%idx-sections-updated_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `deleted_by`
        $this->createIndex(
            '{{%idx-sections-deleted_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `restored_by`
        $this->createIndex(
            '{{%idx-sections-restored_by}}',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%sections}}');
    }
}
