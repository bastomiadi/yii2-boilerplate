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

        $this->batchInsert('{{%menu}}', ['name', 'parent', 'route', 'order', 'data'], [
            ['User Management', NULL, NULL, NULL, '{"icon": "user-plus", "iconStyle": "fas"}'],
            ['Rbac', 1, NULL, 0, '{"icon": "lock", "iconStyle": "fas"}'],
            ['Roles', 2, '/admin/role/index', NULL, '{"icon": "chain", "iconStyle": "fas"}'],
            ['Permissions', 2, '/admin/permission/index', NULL, '{"icon": "check", "iconStyle": "fas"}'],
            ['Routes', 2, '/admin/route/index', NULL, '{"icon": "map-marker", "iconStyle": "fas"}'],
            ['Menus', 2, '/admin/menu/index', NULL, '{"icon": "book", "iconStyle": "fas"}'],
            ['Assignments', 2, '/admin/assignment/index', NULL, '{"icon": "check-square", "iconStyle": "fas"}'],
            ['List Users', 1, '/user/index', NULL, '{"icon": "users", "iconStyle": "fas"}'],
            ['Masters', NULL, NULL, NULL, '{"icon": "list", "iconStyle": "fas"}'],
            [ 'Products', 9, '/products/index', NULL, '{"icon": "table", "iconStyle": "fas"}'],
            [ 'Categories', 9, '/categories/index', NULL, '{"icon": "tags", "iconStyle": "fas"}'],
            [ 'Gii', 1, '/gii/default/index', NULL, '{"icon": "gears", "iconStyle": "fas"}'],
            [ 'Dashboard', NULL, '/site/index', NULL, '{"icon": "tachometer-alt", "iconStyle": "fas"}'],
            [ 'Logs Audit', NULL, '/audit-entry/index', NULL, '{"icon": "sticky-note", "iconStyle": "fas"}'],
            [ 'Status User', 1, '/status-user/index', NULL, '{"icon": "user-times", "iconStyle": "fas"}'],
            [ 'Gender', 9, '/genders/index', NULL, '{"icon": "venus-mars", "iconStyle": "fas"}'],
            [ 'Marital', 9, '/marital/index', NULL, '{"icon": "handshake-o", "iconStyle": "fas"}'],
            [ 'Classes', 9, '/classes/index', NULL, '{"icon": "institution", "iconStyle": "fas"}'],
            [ 'Sections', 9, '/sections/index', NULL, '{"icon": "address-card", "iconStyle": "fas"}'],
            [ 'Students', 9, '/students/index', NULL, '{"icon": "id-card", "iconStyle": "fas"}'],
            [ 'Profiles', 9, '/profiles/index', NULL, '{"icon": "address-book", "iconStyle": "fas"}'],
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
