<?php

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

        $this->batchInsert('{{%marital}}', ['marital_name','created_at','updated_at','deleted_at','created_by','updated_by','deleted_by','isDeleted',], [
            ['Married', time(), time(), NULL, 1, 1, NULL, NULL],
            ['Widowed', time(), time(), NULL, 1, 1, NULL, NULL],
            ['Separated', time(), time(), NULL, 1, 1, NULL, NULL],
            ['Divorced', time(), time(), NULL, 1, 1, NULL, NULL],
            ['Single', time(), time(), NULL, 1, 1, NULL, NULL],
        ]);
            
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240118_023157_seed_marital_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240118_023157_seed_marital_table cannot be reverted.\n";

        return false;
    }
    */
}
