<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%auto_number}}`.
 */
class m240625_132528_create_auto_number_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%auto_number}}', [
            'group' => Schema::TYPE_STRING . '(32) NOT NULL',
            'number' => Schema::TYPE_INTEGER,
            'optimistic_lock' => Schema::TYPE_INTEGER,
            'update_time' => Schema::TYPE_INTEGER,
            'PRIMARY KEY ([[group]])'
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auto_number}}');
    }
}
