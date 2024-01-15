<?php

use yii\db\Migration;

/**
 * Class m240115_020029_auth_item_child_table
 */
class m240115_020029_auth_item_child_table extends Migration
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

        $this->createTable('{{%auth_item_child}}', [
            'parent' => $this->string(64)->notNull(),
            'child' => $this->string(64)->notNull(),
            'PRIMARY KEY ([[parent]], [[child]])',
            'FOREIGN KEY ([[parent]]) REFERENCES {{%auth_item}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[child]]) REFERENCES {{%auth_item}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        $this->batchInsert('{{%auth_item_child}}', ['parent', 'child'], [

            ['admin', '/admin/assignment/*'],
            ['admin', '/admin/assignment/index'],
            ['admin', '/admin/menu/*'],
            ['admin', '/admin/menu/index'],
            ['admin', '/admin/permission/*'],
            ['admin', '/admin/permission/index'],
            ['admin', '/admin/role/*'],
            ['admin', '/admin/role/index'],
            ['admin', '/admin/route/*'],
            ['admin', '/admin/route/index'],
            ['admin', '/admin/rule/*'],
            ['admin', '/admin/rule/index'],
            ['admin', '/admin/user/*'],
            ['admin', '/admin/user/index'],
            ['admin', '/admin/user/signup'],
            ['admin', '/categories/*'],
            ['member', '/categories/create'],
            ['admin', '/categories/index'],
            ['member', '/categories/index'],
            ['admin', '/gii/*'],
            ['admin', '/gii/default/index'],
            ['admin', '/gridview/*'],
            ['member', '/gridview/*'],
            ['admin', '/products/*'],
            ['member', '/products/create'],
            ['admin', '/products/index'],
            ['member', '/products/index'],
            ['admins', 'admin'],
            ['admins', 'member'],
            ['members', 'member'],

        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item_child}}');
    }
}
