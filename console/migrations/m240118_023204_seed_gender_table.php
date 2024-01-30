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
        $this->batchInsert('{{%genders}}', ['gender_name', 'created_at','updated_at','deleted_at','created_by','updated_by','deleted_by','isDeleted',], [
            ['Tidak diketahui', new Expression('NOW()'), new Expression('NOW()'), NULL, 1, 1, NULL, 0],
            ['Laki-Laki', new Expression('NOW()'), new Expression('NOW()'), NULL, 1, 1, NULL, 0],
            ['Perempuan', new Expression('NOW()'), new Expression('NOW()'), NULL, 1, 1, NULL, 0],
            ['Tidak Dapat Ditentukan', new Expression('NOW()'), new Expression('NOW()'), NULL, 1, 1, NULL, 0],
            ['Tidak Mengisi', new Expression('NOW()'), new Expression('NOW()'), NULL, 1, 1, NULL, 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240118_023204_seed_gender_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240118_023204_seed_gender_table cannot be reverted.\n";

        return false;
    }
    */
}
