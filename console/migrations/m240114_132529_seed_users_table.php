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
        // for ($i = 0; $i < $this->count; $i++) {
        //     $user = new User();
        //     $user->username = $this->faker->userName;
        //     $user->email = $this->faker->email;
        //     $user->setPassword('password');
        //     $user->generateAuthKey();
        //     $user->generateEmailVerificationToken();
        //     $user->status = User::STATUS_ACTIVE;
        //     $user->save();
        // }

        $data = array();
        for ($i=1; $i <= $this->count; $i++) { 
            $data[$i]['id'] = $i;
            $data[$i]['username'] = $this->faker->userName;
            $data[$i]['auth_key'] = Yii::$app->getSecurity()->generateRandomString();
            $data[$i]['password_hash'] = Yii::$app->getSecurity()->generatePasswordHash('password');
            $data[$i]['password_reset_token'] = null;
            $data[$i]['email'] = $this->faker->email;
            $data[$i]['status'] = User::STATUS_ACTIVE;
            $data[$i]['created_at'] = time();
            $data[$i]['updated_at'] = time();
            $data[$i]['verification_token'] = Yii::$app->security->generateRandomString() . '_' . time();
        }

        $this->batchInsert('{{%user}}', ['id', 'username', 'auth_key', 'password_hash', 'password_reset_token', 'email', 'status', 'created_at', 'updated_at', 'verification_token'], 
        $data);

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
