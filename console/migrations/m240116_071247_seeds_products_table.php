<?php

use common\models\v1\Categories;
use common\models\v1\Products;
use common\models\v1\User;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240116_071247_seeds_products_table
 */
class m240116_071247_seeds_products_table extends Migration
{
    public $faker, $count, $chunk;

    public function __construct() {
        $this->faker = \Faker\Factory::create();
        $this->count = 9000000;
        $this->chunk = 1000;
        parent::__construct();  // Make sure to call parent constructor
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [];
        $users = User::find()->all();
        $categories = Categories::find()->all();

        $batchSize = 10; // Process 10,000 records per batch
        $totalRecords = 100; // Total records to generate
        $batch = [];
        $timestampExpression = $this->db->driverName === 'mysql' ? new Expression('UNIX_TIMESTAMP()') : new Expression("EXTRACT(EPOCH FROM NOW())::bigint");

        for ($i = 0; $i < $totalRecords; $i++) {
            $batch[] = [
                'product_name' => $this->faker->name,
                'category' => $this->faker->randomElement($categories)->id,
                'created_at' => $timestampExpression,
                'updated_at' => $timestampExpression,
                'deleted_at' => null,
                'created_by' => $this->faker->randomElement($users)->id,
                'updated_by' => $this->faker->randomElement($users)->id,
                'deleted_by' => null,
            ];

            if (count($batch) >= $batchSize) {
                Yii::$app->db->createCommand()->batchInsert('{{%products}}', ['product_name', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], $batch)->execute();
                $batch = [];
            }
        }

        // Insert any remaining records
        if (count($batch) > 0) {
            Yii::$app->db->createCommand()->batchInsert('{{%products}}', ['product_name', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], $batch)->execute();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240116_071247_seeds_products_table cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240116_071247_seeds_products_table cannot be reverted.\n";

        return false;
    }
    */
}
