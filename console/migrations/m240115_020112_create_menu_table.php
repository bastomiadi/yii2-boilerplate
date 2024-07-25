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
            [1, 'User Management', NULL, NULL, NULL, NULL],
            [2, 'Rbac', 1, NULL, 0, NULL],
            [3, 'Roles', 2, '/admin/role/index', NULL, NULL],
            [4, 'Permissions', 2, '/admin/permission/index', NULL, NULL],
            [5, 'Routes', 2, '/admin/route/index', NULL, NULL],
            [6, 'Menus', 2, '/admin/menu/index', NULL, NULL],
            [7, 'Assignments', 2, '/admin/assignment/index', NULL, NULL],
            [8, 'List Users', 1, '/user/index', NULL, NULL],
            [9, 'Masters', NULL, NULL, NULL, NULL],
            [10, 'Products', 9, '/products/index', NULL, NULL],
            [11, 'Categories', 9, '/categories/index', NULL, NULL],
            [12, 'Gii', 1, '/gii/default/index', NULL, NULL],
            // [13, 'Profile', NULL, '/site/profile', NULL, NULL],
            [13, 'Dashboard', NULL, '/site/index', NULL, NULL],
            [14, 'Logs Audit', NULL, '/audit-entry/index', NULL, NULL],
            [15, 'Status User', 1, '/status-user/index', NULL, NULL],
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
