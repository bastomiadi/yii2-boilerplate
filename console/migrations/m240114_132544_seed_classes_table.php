<?php

use common\models\User;
use common\models\v1\Classes;
use yii\db\Migration;

/**
 * Class m240114_132544_seed_classes_table
 */
class m240114_132544_seed_classes_table extends Migration
{

    public $faker, $count;

    function __construct() {
        $this->faker = \Faker\Factory::create();
        $this->count = 100;
    }

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $users = User::find()->all();

        for ($i = 0; $i < $this->count; $i++) {
            $classes = new Classes();
            $classes->detachBehavior('blameable');
            //$classes->disableBehaviour('softDeleteBehavior');
            $classes->name = $this->faker->name;
            $classes->created_by = $this->faker->randomElement($users)->id;
            $classes->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240114_132544_seed_classes_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240114_132544_seed_classes_table cannot be reverted.\n";

        return false;
    }
    */
}
