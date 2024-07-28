<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%status_user}}`.
 */
class m130523_062900_create_status_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%status_user}}', [
            'id' => $this->bigPrimaryKey(),
            'status' => $this->string()->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->integer()->notNull()->defaultValue(0),
        ], $tableOptions);

        $now = $this->db->driverName === 'mysql' ? new Expression('unix_timestamp(NOW())') : new Expression('EXTRACT(epoch FROM NOW())');

        $this->batchInsert('{{%status_user}}', ['id', 'status', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], [
            [1, 'Deleted', $now, $now, null, 1, 1, null, 0],
            [9, 'Inactive', $now, $now, null, 1, 1, null, 0],
            [10, 'Active', $now, $now, null, 1, 1, null, 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%status_user}}');
    }
}
