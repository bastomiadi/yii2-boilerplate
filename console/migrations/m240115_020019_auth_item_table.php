<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m240115_020019_auth_item_table
 */
class m240115_020019_auth_item_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        $timestampExpression = new Expression('NOW()');

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
            $timestampExpression = new Expression('unix_timestamp(NOW())');
        } elseif ($this->db->driverName === 'pgsql') {
            $timestampExpression = new Expression('extract(epoch from now())');
        }

        $this->createTable('{{%auth_item}}', [
            'name' => $this->string(64)->notNull(),
            'type' => $this->integer(),
            'description' => $this->text(),
            'rule_name' => $this->string(64),
            'data' => $this->text(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'PRIMARY KEY ([[name]])',
            'FOREIGN KEY ([[rule_name]]) REFERENCES {{%auth_rule}} ([[name]]) ON DELETE CASCADE ON UPDATE CASCADE',
        ], $tableOptions);

        /**
         * Default roles and permissions of this application.
         */
        $this->batchInsert('{{%auth_item}}',
            ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'], [
                // Role and Permission Entries
                ['admin_web', 2, 'Permission for Web Admins', null, null, $timestampExpression, $timestampExpression],
                ['admin', 1, 'Role for Super Administrator', null, null, $timestampExpression, $timestampExpression],
                ['member_web', 2, 'Permission for Web Members', null, null, $timestampExpression, $timestampExpression],
                ['member', 1, 'Role for Member users', null, null, $timestampExpression, $timestampExpression],
                ['admin_restful', 2, 'Permission for Restful Admins', null, null, $timestampExpression, $timestampExpression],
                ['member_restful', 2, 'Permission for Restful Members', null, null, $timestampExpression, $timestampExpression],

                // Permissions for Web Interface
                ['/admin/assignment/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/assignment/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/menu/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/menu/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/permission/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/permission/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/role/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/role/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/route/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/route/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/rule/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/rule/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/user/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/user/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/admin/user/signup', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/categories/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/categories/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/categories/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/gii/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/gii/default/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/gridview/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/products/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/products/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/products/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/site/profile', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/site/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/audit-entry/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/audit-entry/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/user/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/user/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/status-user/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/status-user/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/debug/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/site/logout', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/genders/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/genders/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/marital/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/marital/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/profiles/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/profiles/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/classes/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/classes/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/sections/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/sections/*', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/students/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/students/*', 2, null, null, null, $timestampExpression, $timestampExpression],

                // Permissions for Restful API v1
                ['/v1/categories/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/categories/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/categories/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/categories/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/categories/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/products/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/products/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/products/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/products/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/products/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/classes/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/classes/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/classes/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/classes/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/classes/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/sections/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/sections/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/sections/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/sections/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/sections/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/students/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/students/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/students/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/students/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/students/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/user/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/user/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/user/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/user/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/user/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/genders/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/genders/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/genders/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/genders/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/genders/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/marital/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/marital/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/marital/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/marital/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/marital/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/status-user/index', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/status-user/create', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/status-user/update', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/status-user/delete', 2, null, null, null, $timestampExpression, $timestampExpression],
                ['/v1/status-user/restore', 2, null, null, null, $timestampExpression, $timestampExpression],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%auth_item}}');
    }
}
