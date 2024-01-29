<?php

use common\models\v1\User;
use yii\db\Migration;

/**
 * Class m240115_020051_auth_assignment_table
 */
class m240115_020051_auth_assignment_table extends Migration
{

     /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        $users = User::find()->all();
        $auth = Yii::$app->authManager;
        // You should previously init it once, e.c. in migration, like this: $auth->createRole('member');
        //$admin = $auth->getRole('member');
        $member = $auth->getRole('member');
        $member_web = $auth->getRole('member_web');

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%auth_assignment}}', [
            'item_name' => $this->string(64)->notNull(),
            'user_id' => $this->bigInteger()->notNull(),
            'created_at' => $this->bigInteger(),
            'PRIMARY KEY ([[item_name]], [[user_id]])',
            'FOREIGN KEY ([[user_id]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[item_name]]) REFERENCES {{%auth_item}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        foreach ($users as $key => $value) {
            $auth->assign($member, $value->id);
            //$auth->assign($member_web, $value->id);
        }

        $this->batchInsert('{{%auth_assignment}}', ['item_name', 'user_id', 'created_at'], [
            //['admin_web', 1, NULL],
            ['admin', 1, NULL],
            //['member_web', 2, NULL],
            //['member', 2, NULL],
        ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_assignment}}');
    }
}
