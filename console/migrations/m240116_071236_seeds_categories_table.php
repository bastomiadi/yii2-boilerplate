<?php

use common\models\v1\User;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240116_071236_seeds_categories_table
 */
class m240116_071236_seeds_categories_table extends Migration
{
    public $faker, $count;

    public function __construct()
    {
        $this->faker = \Faker\Factory::create();
        $this->count = 5;
        parent::__construct();  // Ensure the parent constructor is called
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $data = [];
        $users = User::find()->all();
        $timestampExpression = $this->db->driverName === 'mysql' ? new Expression('UNIX_TIMESTAMP()') : new Expression("EXTRACT(EPOCH FROM NOW())::bigint");

        for ($i = 1; $i <= $this->count; $i++) {
            $data[] = [
                'category_name' => $this->faker->name,
                'created_at' => $timestampExpression,
                'updated_at' => $timestampExpression,
                'deleted_at' => null,
                'created_by' => $this->faker->randomElement($users)->id,
                'updated_by' => $this->faker->randomElement($users)->id,
                'deleted_by' => null,
            ];
        }

        // Perform batch insert
        Yii::$app->db->createCommand()->batchInsert('{{%categories}}', ['category_name', 'created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by'], $data)->execute();

        // Reset the sequence for PostgreSQL
        // if ($this->db->driverName === 'pgsql') {
        //     $this->execute("SELECT setval(pg_get_serial_sequence('{{%categories}}', 'id'), COALESCE((SELECT MAX(id) + 1 FROM {{%categories}}), 1), false)");
        // }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240116_071236_seeds_categories_table cannot be reverted.\n";
        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240116_071236_seeds_categories_table cannot be reverted.\n";

        return false;
    }
    */
}
