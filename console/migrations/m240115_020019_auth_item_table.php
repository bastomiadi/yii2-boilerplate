<?php

use yii\db\Expression;
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
               ['/admin/assignment/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/assignment/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/menu/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/menu/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/permission/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/permission/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/role/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/role/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/route/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/route/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/rule/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/rule/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/user/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/user/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/admin/user/signup', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/categories/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/categories/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/categories/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/gii/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/gii/default/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/gridview/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/products/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/products/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/products/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/site/profile', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/site/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/audit-entry/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/audit-entry/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/user/*', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/user/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],

               //for restful permission v1
               ['/v1/categories/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/categories/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/categories/update', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/categories/delete', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/products/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/products/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/products/update', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/products/delete', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/classes/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/classes/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/classes/update', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/classes/delete', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/sections/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/sections/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/sections/update', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/sections/delete', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/students/index', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/students/create', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/students/update', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['/v1/students/delete', 2, NULL, NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],

               ['admin_web', 2, 'Permission for Web Admins', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['admin', 1, 'Role for Super Administrator', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['member_web', 2, 'Permission for Web Members', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['member', 1, 'Role for Member users', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['admin_restful', 2, 'Permission for Restful Admins', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
               ['member_restful', 2, 'Permission for Restful Members', NULL, NULL, new Expression('NOW()'), new Expression('NOW()')],
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
