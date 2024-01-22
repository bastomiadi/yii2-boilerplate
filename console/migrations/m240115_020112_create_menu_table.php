<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%menu}}`.
 */
class m240115_020112_create_menu_table extends Migration
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

        $this->createTable('{{%menu}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string(128)->notNull(),
            'parent' => $this->bigInteger(),
            'route' => $this->string(),
            'order' => $this->bigInteger(),
            'data' => $this->binary(),
            "FOREIGN KEY ([[parent]]) REFERENCES {{%menu}}([[id]]) ON DELETE SET NULL ON UPDATE CASCADE",
        ], $tableOptions);

        $this->batchInsert('{{%menu}}', ['id', 'name', 'parent', 'route', 'order', 'data'], [
            [1, 'Rbac', NULL, NULL, 0, NULL],
            [2, 'Roles', 1, '/admin/role/index', NULL, NULL],
            [3, 'Permissions', 1, '/admin/permission/index', NULL, NULL],
            [4, 'Routes', 1, '/admin/route/index', NULL, NULL],
            [5, 'Menus', 1, '/admin/menu/index', NULL, NULL],
            [6, 'Assignments', 1, '/admin/assignment/index', NULL, NULL],
            [7, 'User Management', NULL, NULL, 1, NULL],
            [8, 'List Users', 7, '/admin/user/index', NULL, NULL],
            [9, 'Add User', 7, '/admin/user/signup', NULL, NULL],
            [10, 'Masters', NULL, NULL, NULL, NULL],
            [11, 'Products', 10, '/products/index', NULL, NULL],
            [12, 'Categories', 10, '/categories/index', NULL, NULL],
            [13, 'Gii', 1, '/gii/default/index', NULL, NULL],
            [14, 'Profile', NULL, '/site/profile', NULL, NULL],
            [15, 'Dashboard', NULL, '/site/index', NULL, NULL],
            [16, 'Logs Audit', NULL, '/audit-entry/index', NULL, NULL],
            [17, 'Users', 10, '/user/index', NULL, NULL],
        ]);
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%menu}}');
    }
}
