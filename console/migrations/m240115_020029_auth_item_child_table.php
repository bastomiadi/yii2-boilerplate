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

            ['admin_web', '/admin/assignment/*'],
            ['admin_web', '/admin/assignment/index'],
            ['admin_web', '/admin/menu/*'],
            ['admin_web', '/admin/menu/index'],
            ['admin_web', '/admin/permission/*'],
            ['admin_web', '/admin/permission/index'],
            ['admin_web', '/admin/role/*'],
            ['admin_web', '/admin/role/index'],
            ['admin_web', '/admin/route/*'],
            ['admin_web', '/admin/route/index'],
            ['admin_web', '/admin/rule/*'],
            ['admin_web', '/admin/rule/index'],
            ['admin_web', '/admin/user/*'],
            ['admin_web', '/admin/user/index'],
            ['admin_web', '/admin/user/signup'],
            ['admin_web', '/categories/*'],
            ['member_web', '/categories/create'],
            ['admin_web', '/categories/index'],
            ['member_web', '/categories/index'],
            ['admin_web', '/gii/*'],
            ['admin_web', '/gii/default/index'],
            ['admin_web', '/gridview/*'],
            ['member_web', '/gridview/*'],
            ['admin_web', '/products/*'],
            ['member_web', '/products/create'],
            ['admin_web', '/products/index'],
            ['member_web', '/products/index'],
            ['admin_web', '/site/profile'],
            ['admin_web', '/site/index'],
            ['admin', 'admin_web'],
            ['admin', 'member_web'],
            ['member', 'member_web'],
            ['member', 'member_restful'],
            ['admin', 'admin_restful'],
            ['admin', 'member_restful'],
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
