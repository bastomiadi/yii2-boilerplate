<?php

use common\models\v1\User;
use yii\db\Migration;

/**
 * Class m240116_071236_seeds_categoriess_table
 */
class m240116_071236_seeds_categories_table extends Migration
{
    public $faker, $count;

    function __construct() {
        $this->faker = \Faker\Factory::create();
        $this->count = 50;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = array();
        $users = User::find()->all();

        for ($i=1; $i <= $this->count; $i++) { 
            $data[$i]['id'] = $i;
            $data[$i]['category_name'] = $this->faker->fileName;
            $data[$i]['created_at'] = time();
            $data[$i]['updated_at'] = time();
            $data[$i]['deleted_at'] = null;
            $data[$i]['created_by'] = $this->faker->randomElement($users)->id;
            $data[$i]['updated_by'] = $this->faker->randomElement($users)->id;
            $data[$i]['deleted_by'] = null;
        }

        $this->batchInsert('{{%categories}}', ['id', 'category_name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], 
        $data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240116_071236_seeds_categoriess_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240116_071236_seeds_categoriess_table cannot be reverted.\n";

        return false;
    }
    */
}
