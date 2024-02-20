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

    function __construct() {
        $this->faker = \Faker\Factory::create();
        $this->count = 1000;
        $this->chunk = 1000;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = array();
        $users = User::find()->all();
        $categories = Categories::find()->all();

        for ($i=1; $i <= $this->count; $i++) { 
            $data[$i]['product_name'] = $this->faker->name;
            $data[$i]['category'] = $this->faker->randomElement($categories)->id;
            $data[$i]['created_at'] = new Expression('unix_timestamp(NOW())');
            $data[$i]['updated_at'] = new Expression('unix_timestamp(NOW())');
            $data[$i]['deleted_at'] = null;
            $data[$i]['created_by'] = $this->faker->randomElement($users)->id;
            $data[$i]['updated_by'] = $this->faker->randomElement($users)->id;
            $data[$i]['deleted_by'] = null;
        }

        // $chunk_data = array_chunk($data, $this->chunk);
        // if (isset($chunk_data) && !empty($chunk_data)){
        //     foreach ($chunk_data as $key => $value) {
        //         $this->batchInsert('{{%products}}', ['product_name', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], $value);
        //     }
        // }

        // Specify the size of each chunk
        $chunkSize = 100; // You can adjust this based on your needs

        // Get the database connection
        $db = Yii::$app->db;

        // Start a database transaction
        $transaction = $db->beginTransaction();

        try {

            // Loop through the data in chunks
            foreach (array_chunk($data, $chunkSize) as $chunk) {
                // Use batchInsert to insert the chunk into the database
                $db->createCommand()->batchInsert('{{%products}}', ['product_name', 'category', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], $chunk)->execute();
            }

            // Commit the transaction
            $transaction->commit();

            // Do any other necessary post-insertion tasks

        } catch (\Exception $e) {
            // If an exception occurs, roll back the transaction
            $transaction->rollBack();

            // Handle the exception as needed
            throw $e;
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
