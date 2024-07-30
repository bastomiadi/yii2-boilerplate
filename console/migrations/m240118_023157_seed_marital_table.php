<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240118_023157_seed_marital_table
 */
class m240118_023157_seed_marital_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Determine the appropriate expression for current timestamp
        $currentTimestamp = $this->db->driverName === 'mysql' ? new Expression('unix_timestamp(NOW())') : new Expression('extract(epoch from now())');

        $this->batchInsert('{{%marital}}', [
            'marital_name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'
        ], [
            ['Married', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Widowed', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Separated', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Divorced', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Single', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
        ]);

        // Reset the sequence for PostgreSQL
        // if ($this->db->driverName === 'pgsql') {
        //     $this->execute("SELECT setval(pg_get_serial_sequence('{{%marital}}', 'id'), COALESCE((SELECT MAX(id) + 1 FROM {{%marital}}), 1), false)");
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%marital}}', ['marital_name' => ['Married', 'Widowed', 'Separated', 'Divorced', 'Single']]);
    }
}
