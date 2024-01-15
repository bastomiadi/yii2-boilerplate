<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m240114_132529_seed_users_table
 */
class m240114_132529_seed_users_table extends Migration
{

    public $faker, $count;

    function __construct() {
        $this->faker = \Faker\Factory::create();
        $this->count = 10;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 0; $i < $this->count; $i++) {
            $user = new User();
            $user->username = $this->faker->userName;
            $user->email = $this->faker->email;
            $user->setPassword('password');
            $user->generateAuthKey();
            $user->generateEmailVerificationToken();
            $user->status = User::STATUS_ACTIVE;
            $user->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240114_132529_seed_users_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240114_132529_seed_users_table cannot be reverted.\n";

        return false;
    }
    */
}
