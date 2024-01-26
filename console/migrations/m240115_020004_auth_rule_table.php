<?php

use yii\db\Migration;

/**
 * Class m240115_020004_auth_rule_table
 */
class m240115_020004_auth_rule_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%auth_rule}}', [
            'name' => $this->string(64)->notNull(),
            'data' => $this->text(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'PRIMARY KEY ([[name]])',
        ], $tableOptions);

         /**
        * Default rule of this application .
        */
       $this->batchInsert('{{%auth_rule}}',
       ['name', 'data', 'created_at', 'updated_at'], [
        ['isAuthor', 'O:28:"common\components\AuthorRule":3:{s:4:"name";s:8:"isAuthor";s:9:"createdAt";i:1706150897;s:9:"updatedAt";i:1706150897;}', 1706150897, 1706150897]
       ]);

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_rule}}');
    }
}
