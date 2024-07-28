<?php

use common\models\v1\Genders;
use common\models\v1\Marital;
use common\models\v1\User;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240118_023214_seed_profile_table
 */
class m240118_023214_seed_profile_table extends Migration
{
    public $faker;

    function __construct() {
        $this->faker = \Faker\Factory::create();
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $users = User::find()->all();
        $gender = Genders::find()->all();
        $marital = Marital::find()->all();
        $data = [];

        // Determine the appropriate expression for current timestamp
        $currentTimestamp = $this->db->driverName === 'mysql' ? new Expression('unix_timestamp(NOW())') : new Expression('extract(epoch from now())');

        foreach ($users as $key => $value) {
            $data[$key]['user' ] = $value->id;
            $data[$key]['first_name' ] = $this->faker->firstName;
            $data[$key]['last_name' ] = $this->faker->lastName;
            $data[$key]['phone_number'] = $this->faker->phoneNumber;
            $data[$key]['address' ] = $this->faker->address;
            $data[$key]['gender' ] = $this->faker->randomElement($gender)->id;
            $data[$key]['marital'] = $this->faker->randomElement($marital)->id;
            $data[$key]['profile_image' ] = 'https://adminlte.io/themes/v3/dist/img/user2-160x160.jpg';
            $data[$key]['date_of_birth'] = $this->faker->date($format = 'Y-m-d', $max = 'now');
            $data[$key]['created_at'] = $currentTimestamp;
            $data[$key]['updated_at'] = $currentTimestamp;
            $data[$key]['deleted_at'] = null;
            $data[$key]['created_by'] = $value->id;
            $data[$key]['updated_by'] = $value->id;
            $data[$key]['deleted_by'] = null;
            $data[$key]['isDeleted'] = 0;
        }

        $this->batchInsert('{{%profiles}}', [
            'user', 'first_name', 'last_name', 'phone_number', 'address', 'gender', 'marital', 
            'profile_image', 'date_of_birth', 'created_at', 'updated_at', 'deleted_at', 
            'created_by', 'updated_by', 'deleted_by', 'isDeleted'
        ], $data);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%profiles}}');
    }
}
