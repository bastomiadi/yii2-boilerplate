<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240118_023204_seed_gender_table
 */
class m240118_023204_seed_gender_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Determine the appropriate expression for current timestamp
        $currentTimestamp = $this->db->driverName === 'mysql' ? new Expression('unix_timestamp(NOW())') : new Expression('extract(epoch from now())');

        $this->batchInsert('{{%genders}}', [
            'gender_name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'
        ], [
            ['Tidak diketahui', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Laki-Laki', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Perempuan', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Tidak Dapat Ditentukan', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
            ['Tidak Mengisi', $currentTimestamp, $currentTimestamp, null, 1, 1, null, 0],
        ]);

        // Reset the sequence for PostgreSQL
        if ($this->db->driverName === 'pgsql') {
            $this->execute("SELECT setval(pg_get_serial_sequence('{{%genders}}', 'id'), COALESCE((SELECT MAX(id) + 1 FROM {{%genders}}), 1), false)");
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%genders}}', ['gender_name' => [
            'Tidak diketahui', 'Laki-Laki', 'Perempuan', 'Tidak Dapat Ditentukan', 'Tidak Mengisi'
        ]]);
    }
}
