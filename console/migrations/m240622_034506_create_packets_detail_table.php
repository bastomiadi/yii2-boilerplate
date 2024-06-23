<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%packets_detail}}`.
 */
class m240622_034506_create_packets_detail_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%packets_detail}}', [
            'id' => $this->primaryKey(),
            'packet' => $this->bigInteger()->notNull(),
            'id_product_rsgh' => $this->bigInteger()->notNull(),
            'name_product_rsgh' => $this->string(255)->notNull(),
            'normal_price' => $this->bigInteger()->notNull(),
            'custom_price' => $this->bigInteger()->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->null(),
            'updated_by' => $this->bigInteger()->null(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
            'FOREIGN KEY ([[packet]]) REFERENCES {{%packets}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[id_product_rsgh]]) REFERENCES {{%products_rsgh}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[created_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[updated_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[deleted_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'INDEX idx_packet ([[packet]])',
            'INDEX idx_id_product_rsgh ([[id_product_rsgh]])',
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
        $this->dropTable('{{%packets_detail}}');
    }
}
