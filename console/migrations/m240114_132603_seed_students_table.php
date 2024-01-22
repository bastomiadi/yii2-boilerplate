<?php

use common\models\User;
use common\models\v1\Classes;
use common\models\v1\Sections;
use common\models\v1\Students;
use yii\db\Migration;

/**
 * Class m240114_132603_seed_students_table
 */
class m240114_132603_seed_students_table extends Migration
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
        $sections = Sections::find()->all();
        $classes = Classes::find()->all();

        for ($i = 0; $i < $this->count; $i++) {
            $students = new Students();
            $students->detachBehavior('blameable');
            $students->detachBehavior('auditEntryBehaviors');
            $students->sections = $this->faker->randomElement($sections)->id;
            $students->classes = $this->faker->randomElement($classes)->id;
            $students->name = $this->faker->name;
            $students->email = $this->faker->email;
            $students->address = $this->faker->address;
            $students->phone_number = $this->faker->phoneNumber;
            $students->created_by = $this->faker->randomElement($users)->id;
            $students->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240114_132603_seed_students_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240114_132603_seed_students_table cannot be reverted.\n";

        return false;
    }
    */
}
