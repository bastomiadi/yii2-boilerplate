<?php

use common\models\User;
use common\models\v1\Classes;
use common\models\v1\Sections;
use yii\db\Migration;

/**
 * Class m240114_132551_seed_sections_table
 */
class m240114_132551_seed_sections_table extends Migration
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
        $classes = Classes::find()->all();

        for ($i = 0; $i < $this->count; $i++) {
            $sections = new Sections();
            $sections->detachBehavior('blameable');
            $sections->detachBehavior('auditEntryBehaviors');
            $sections->name = $this->faker->name;
            $sections->classes = $this->faker->randomElement($classes)->id;
            $sections->created_by = $this->faker->randomElement($users)->id;
            $sections->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240114_132551_seed_sections_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240114_132551_seed_sections_table cannot be reverted.\n";

        return false;
    }
    */
}
