<?php

use yii\db\Migration;

/**
 * Class m190612_092611_tbl_audit_entry
 */
class m190612_092611_tbl_audit_entry extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // https://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        //Create our first version of the tbl_auditentry table
        //upgrade it from here if we ever need to. This was done so
        $this->createTable('{{%audit_entry}}',
            [
                'audit_entry_id' => $this->bigPrimaryKey(),
                'audit_entry_timestamp' => $this->string()->notNull(),
                'audit_entry_model_name' =>$this->string()->notNull(),
                'audit_entry_operation' => $this->string()->notNull(),
                'audit_entry_field_name' => $this->string(),
                'audit_entry_old_value' => $this->text(),
                'audit_entry_new_value' => $this->text(),
                'audit_entry_user_id' => $this->string(),
                'audit_entry_ip' => $this->string(),
            ], $tableOptions
        );
        
        //Indexing
        $this->createIndex( 'idx_audit_entry_user_id', '{{%audit_entry}}', 'audit_entry_user_id');
        $this->createIndex( 'idx_audit_entry_model_name', '{{%audit_entry}}', 'audit_entry_model_name');
        $this->createIndex( 'idx_audit_entry_operation', '{{%audit_entry}}', 'audit_entry_operation');
        $this->createIndex( 'idx_audit_entry_ip', '{{%audit_entry}}', 'audit_entry_ip');
    }
    public function safeDown()
    {
        $this->dropTable('{{%audit_entry}}');
    }
    
}
