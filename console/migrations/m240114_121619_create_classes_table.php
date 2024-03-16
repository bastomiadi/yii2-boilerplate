<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%classes}}`.
 */
class m240114_121619_create_classes_table extends Migration
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

        $this->createTable('{{%classes}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ], $tableOptions);
        
        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-created_by}}',
            '{{%classes}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-updated_by}}',
            '{{%classes}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-deleted_by}}',
            '{{%classes}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create index for column `created_by`
        $this->createIndex(
            '{{%idx-classes-created_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `updated_by`
        $this->createIndex(
            '{{%idx-classes-updated_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `deleted_by`
        $this->createIndex(
            '{{%idx-classes-deleted_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `restored_by`
        $this->createIndex(
            '{{%idx-classes-restored_by}}',
            '{{%user}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%classes}}');
    }
}
