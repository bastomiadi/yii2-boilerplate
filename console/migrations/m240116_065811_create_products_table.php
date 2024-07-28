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
            'isDeleted' => $this->boolean()->notNull()->defaultValue(false),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ], $tableOptions);

        // Adding foreign keys
        $this->addForeignKey(
            'fk-products-category',
            '{{%products}}',
            'category',
            '{{%categories}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-created_by',
            '{{%products}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-updated_by',
            '{{%products}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-deleted_by',
            '{{%products}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-products-restored_by',
            '{{%products}}',
            'restored_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // Adding indexes
        $this->createIndex(
            'idx-products-category',
            '{{%products}}',
            'category'
        );

        $this->createIndex(
            'idx-products-created_by',
            '{{%products}}',
            'created_by'
        );

        $this->createIndex(
            'idx-products-updated_by',
            '{{%products}}',
            'updated_by'
        );

        $this->createIndex(
            'idx-products-deleted_by',
            '{{%products}}',
            'deleted_by'
        );

        $this->createIndex(
            'idx-products-restored_by',
            '{{%products}}',
            'restored_by'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Dropping foreign keys
        $this->dropForeignKey(
            'fk-products-category',
            '{{%products}}'
        );

        $this->dropForeignKey(
            'fk-products-created_by',
            '{{%products}}'
        );

        $this->dropForeignKey(
            'fk-products-updated_by',
            '{{%products}}'
        );

        $this->dropForeignKey(
            'fk-products-deleted_by',
            '{{%products}}'
        );

        $this->dropForeignKey(
            'fk-products-restored_by',
            '{{%products}}'
        );

        // Dropping indexes
        $this->dropIndex(
            'idx-products-category',
            '{{%products}}'
        );

        $this->dropIndex(
            'idx-products-created_by',
            '{{%products}}'
        );

        $this->dropIndex(
            'idx-products-updated_by',
            '{{%products}}'
        );

        $this->dropIndex(
            'idx-products-deleted_by',
            '{{%products}}'
        );

        $this->dropIndex(
            'idx-products-restored_by',
            '{{%products}}'
        );

        $this->dropTable('{{%products}}');
    }
}
