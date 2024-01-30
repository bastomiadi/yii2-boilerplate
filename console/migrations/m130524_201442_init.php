<?php

use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->bigPrimaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'status' => $this->smallInteger()->notNull()->defaultValue(9),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
            'deleted_by' => $this->bigInteger()->null(),
            'deleted_at' => $this->bigInteger()->null(),
        ], $tableOptions);

         // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-users-created_by}}',
            '{{%user}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-users-updated_by}}',
            '{{%user}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-users-deleted_by}}',
            '{{%user}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create index for column `created_by`
        $this->createIndex(
            '{{%idx-user-created_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `updated_by`
        $this->createIndex(
            '{{%idx-user-updated_by}}',
            '{{%user}}',
            'id'
        );

        // create index for column `deleted_by`
        $this->createIndex(
            '{{%idx-user-deleted_by}}',
            '{{%user}}',
            'id'
        );

    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
