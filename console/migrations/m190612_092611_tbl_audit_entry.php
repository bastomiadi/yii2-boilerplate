<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m190612_092611_tbl_audit_entry
 */
class m190612_092611_tbl_audit_entry extends Migration
{
    public function safeUp()
    {
        //Create our first version of the tbl_auditentry table
        //upgrade it from here if we ever need to. This was done so
        $this->createTable('{{%audit_entry}}',
            [
                'audit_entry_id' => Schema::TYPE_PK,
                'audit_entry_timestamp' => Schema::TYPE_STRING . ' NOT NULL',
                'audit_entry_model_name' => Schema::TYPE_STRING . ' NOT NULL',
                'audit_entry_operation' => Schema::TYPE_STRING . ' NOT NULL',
                'audit_entry_field_name' => Schema::TYPE_STRING,
                'audit_entry_old_value' => Schema::TYPE_TEXT,
                'audit_entry_new_value' => Schema::TYPE_TEXT,
                'audit_entry_user_id' => Schema::TYPE_STRING,
                'audit_entry_ip' => Schema::TYPE_STRING,
            ]
        );
        
        //Indexing
        $this->createIndex( 'idx_audit_entry_user_id', 'tbl_audit_entry', 'audit_entry_user_id');
        $this->createIndex( 'idx_audit_entry_model_name', 'tbl_audit_entry', 'audit_entry_model_name');
        $this->createIndex( 'idx_audit_entry_operation', 'tbl_audit_entry', 'audit_entry_operation');
        $this->createIndex( 'idx_audit_entry_ip', 'tbl_audit_entry', 'audit_entry_ip');
    }
    public function safeDown()
    {
        $this->dropTable('{{%audit_entry}}');
    }
    
}
