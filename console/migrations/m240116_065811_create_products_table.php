<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240116_065811_create_products_table extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%products}}', [
            'id' => $this->bigPrimaryKey(),
            'product_name' => $this->string(255)->notNull(),
            'category' => $this->bigInteger()->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger()->notNull(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(0),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
            'FOREIGN KEY ([[category]]) REFERENCES {{%categories}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[created_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[updated_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[deleted_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'FOREIGN KEY ([[restored_by]]) REFERENCES {{%user}} ([[id]]) ON DELETE CASCADE ON UPDATE CASCADE',
            'INDEX idx_category ([[category]])',
            'INDEX idx_created_by ([[created_by]])',
            'INDEX idx_updated_by ([[updated_by]])',
            'INDEX idx_deleted_by ([[deleted_by]])',
            'INDEX idx_restored_by ([[restored_by]])',
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
