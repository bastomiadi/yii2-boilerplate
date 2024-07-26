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
            [1, 'User Management', NULL, NULL, NULL, '{"icon": "user-plus", "iconStyle": "fas"}'],
            [2, 'Rbac', 1, NULL, 0, '{"icon": "lock", "iconStyle": "fas"}'],
            [3, 'Roles', 2, '/admin/role/index', NULL, '{"icon": "chain", "iconStyle": "fas"}'],
            [4, 'Permissions', 2, '/admin/permission/index', NULL, '{"icon": "check", "iconStyle": "fas"}'],
            [5, 'Routes', 2, '/admin/route/index', NULL, '{"icon": "map-marker", "iconStyle": "fas"}'],
            [6, 'Menus', 2, '/admin/menu/index', NULL, '{"icon": "book", "iconStyle": "fas"}'],
            [7, 'Assignments', 2, '/admin/assignment/index', NULL, '{"icon": "check-square", "iconStyle": "fas"}'],
            [8, 'List Users', 1, '/user/index', NULL, '{"icon": "users", "iconStyle": "fas"}'],
            [9, 'Masters', NULL, NULL, NULL, '{"icon": "list", "iconStyle": "fas"}'],
            [10, 'Products', 9, '/products/index', NULL, '{"icon": "table", "iconStyle": "fas"}'],
            [11, 'Categories', 9, '/categories/index', NULL, '{"icon": "tags", "iconStyle": "fas"}'],
            [12, 'Gii', 1, '/gii/default/index', NULL, '{"icon": "gears", "iconStyle": "fas"}'],
            [13, 'Dashboard', NULL, '/site/index', NULL, '{"icon": "tachometer-alt", "iconStyle": "fas"}'],
            [14, 'Logs Audit', NULL, '/audit-entry/index', NULL, '{"icon": "sticky-note", "iconStyle": "fas"}'],
            [15, 'Status User', 1, '/status-user/index', NULL, '{"icon": "user-times", "iconStyle": "fas"}'],
            [16, 'Gender', 9, '/genders/index', NULL, '{"icon": "venus-mars", "iconStyle": "fas"}'],
            [17, 'Marital', 9, '/marital/index', NULL, '{"icon": "handshake-o", "iconStyle": "fas"}'],
            [18, 'Classes', 9, '/classes/index', NULL, '{"icon": "institution", "iconStyle": "fas"}'],
            [19, 'Sections', 9, '/sections/index', NULL, '{"icon": "address-card", "iconStyle": "fas"}'],
            [20, 'Students', 9, '/students/index', NULL, '{"icon": "id-card", "iconStyle": "fas"}'],
            [21, 'Profiles', 9, '/profiles/index', NULL, '{"icon": "address-book", "iconStyle": "fas"}'],
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
