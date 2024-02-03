<?php

use yii\db\Migration;

/**
 * Class m240201_141648_create_fk_status_user
 */
class m240201_141648_create_fk_status_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        // add foreign key for table `status_user`
        $this->addForeignKey(
            '{{%fk-status-user-created_by}}',
            '{{%status_user}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `status_user`
        $this->addForeignKey(
            '{{%fk-status-user-updated_by}}',
            '{{%status_user}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `status_user`
        $this->addForeignKey(
            '{{%fk-status-user-deleted_by}}',
            '{{%status_user}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create index for column `created_by`
        $this->createIndex(
            '{{%idx-status-user-created_by}}',
            '{{%status_user}}',
            'created_by'
        );

        // create index for column `updated_by`
        $this->createIndex(
            '{{%idx-status-user-updated_by}}',
            '{{%status_user}}',
            'updated_by'
        );

        // create index for column `deleted_by`
        $this->createIndex(
            '{{%idx-status-user-deleted_by}}',
            '{{%status_user}}',
            'deleted_by'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240201_141648_create_fk_status_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240201_141648_create_fk_status_user cannot be reverted.\n";

        return false;
    }
    */
}
