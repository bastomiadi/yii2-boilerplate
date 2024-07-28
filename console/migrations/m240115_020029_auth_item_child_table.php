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
            ['admin_web', '/categories/index'],
            ['admin_web', '/gii/*'],
            ['admin_web', '/gii/default/index'],
            ['admin_web', '/gridview/*'],
            ['admin_web', '/products/*'],
            ['admin_web', '/products/index'],
            ['admin_web', '/site/profile'],
            ['admin_web', '/site/index'],
            ['admin_web', '/audit-entry/*'],
            ['admin_web', '/audit-entry/index'],
            ['admin_web', '/user/*'],
            ['admin_web', '/user/index'],
            ['admin_web', '/status-user/*'],
            ['admin_web', '/status-user/index'],
            ['admin_web', '/debug/*'],
            ['admin_web', '/site/logout'],
            ['admin_web', '/genders/index'],
            ['admin_web', '/genders/*'],
            ['admin_web', '/marital/index'],
            ['admin_web', '/marital/*'],
            ['admin_web', '/profiles/index'],
            ['admin_web', '/profiles/*'],
            ['admin_web', '/classes/index'],
            ['admin_web', '/classes/*'],
            ['admin_web', '/sections/index'],
            ['admin_web', '/sections/*'],
            ['admin_web', '/students/index'],
            ['admin_web', '/students/*'],

            // for member web
            ['member_web', '/categories/create'],
            ['member_web', '/categories/index'],
            ['member_web', '/gridview/*'],
            ['member_web', '/products/create'],
            ['member_web', '/products/index'],
            ['member_web', '/site/index'],
            ['member_web', '/site/logout'],
            ['member_web', '/site/profile'],

            // for restful permission v1
            ['admin_restful', '/v1/categories/index'],
            ['admin_restful', '/v1/categories/create'],
            ['admin_restful', '/v1/categories/update'],
            ['admin_restful', '/v1/categories/delete'],
            ['admin_restful', '/v1/products/index'],
            ['admin_restful', '/v1/products/create'],
            ['admin_restful', '/v1/products/update'],
            ['admin_restful', '/v1/products/delete'],
            ['admin_restful', '/v1/classes/index'],
            ['admin_restful', '/v1/classes/create'],
            ['admin_restful', '/v1/classes/update'],
            ['admin_restful', '/v1/classes/delete'],
            ['admin_restful', '/v1/sections/index'],
            ['admin_restful', '/v1/sections/create'],
            ['admin_restful', '/v1/sections/update'],
            ['admin_restful', '/v1/sections/delete'],
            ['admin_restful', '/v1/students/index'],
            ['admin_restful', '/v1/students/create'],
            ['admin_restful', '/v1/students/update'],
            ['admin_restful', '/v1/students/delete'],
            ['admin_restful', '/v1/students/restore'],

            // assign permission to role
            ['admin', 'admin_web'],
            ['admin', 'member_web'],
            ['admin', 'admin_restful'],
            ['admin', 'member_restful'],

            // assign permission to role
            ['member', 'member_web'],
            ['member', 'member_restful'],
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
