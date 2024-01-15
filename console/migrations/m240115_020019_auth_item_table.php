<?php

use yii\db\Migration;

/**
 * Class m240115_020019_auth_item_table
 */
class m240115_020019_auth_item_table extends Migration
{ /**
    * @inheritdoc
    */
   public function safeUp()
   {
       $tableOptions = null;

       if ($this->db->driverName === 'mysql') {
           $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
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
           //'CREATE INDEX idx_rule_name {{%auth_item}} ([[rule_name]])',
       ], $tableOptions);

       /**
        * Default roles of this application are superadmin, administrator, editor, author, contributor, subscriber.
        */
       $this->batchInsert('{{%auth_item}}',
           ['name', 'type', 'description', 'rule_name', 'data', 'created_at', 'updated_at'], [
               
               ['/admin/assignment/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/assignment/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/menu/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/menu/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/permission/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/permission/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/role/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/role/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/route/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/route/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/rule/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/rule/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/user/*', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/user/index', 2, NULL, NULL, NULL, 0, 0],
               ['/admin/user/signup', 2, NULL, NULL, NULL, 0, 0],
               ['/categories/*', 2, NULL, NULL, NULL, 0, 0],
               ['/categories/create', 2, NULL, NULL, NULL, 0, 0],
               ['/categories/index', 2, NULL, NULL, NULL, 0, 0],
               ['/gii/*', 2, NULL, NULL, NULL, 0, 0],
               ['/gii/default/index', 2, NULL, NULL, NULL, 0, 0],
               ['/gridview/*', 2, NULL, NULL, NULL, 0, 0],
               ['/products/*', 2, NULL, NULL, NULL, 0, 0],
               ['/products/create', 2, NULL, NULL, NULL, 0, 0],
               ['/products/index', 2, NULL, NULL, NULL, 0, 0],
               ['admin', 2, 'Permission for Admins roles', NULL, NULL, 0, 0],
               ['admins', 1, 'Role for Super Administrator', NULL, NULL, 0, 0],
               ['member', 2, 'Permission for Member roles', NULL, NULL, 0, 0],
               ['members', 1, 'Role for Member or registered user', NULL, NULL, 0, 0],

           ]);
   }

   /**
    * @inheritdoc
    */
   public function safeDown()
   {
       $this->dropTable('{{%auth_item}}');
   }
}
