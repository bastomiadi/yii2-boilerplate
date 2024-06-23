<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%packets}}`.
 */
class m240622_034457_create_packets_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%packets}}', [
            'id' => $this->bigPrimaryKey(),
            'packet_name' => $this->string(255)->notNull(),
            'total_price' => $this->bigInteger()->notNull(),
            'description' => $this->text()->null(),
            'discount_percent' => $this->bigInteger()->notNull(),
            'discount_rupiah' => $this->bigInteger()->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
            'FOREIGN KEY ([[created_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[updated_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[deleted_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'INDEX idx_created_by ([[created_by]])',
            'INDEX idx_updated_by ([[updated_by]])',
            'INDEX idx_deleted_by ([[deleted_by]])',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%packets}}');
    }
}
