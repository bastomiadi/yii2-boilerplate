<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%categories}}`.
 */
class m240116_065804_create_categories_table extends Migration
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

        $this->createTable('{{%categories}}', [
            'id' => $this->bigPrimaryKey(),
            'category_name' => $this->string(255)->notNull(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger()->notNull(),
            'deleted_by' => $this->bigInteger()->null(),
            'isDeleted' => $this->integer()->notNull()->defaultValue(0),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ], $tableOptions);

        $this->addForeignKey(
            'fk-categories-created_by',
            '{{%categories}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-categories-updated_by',
            '{{%categories}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-categories-deleted_by',
            '{{%categories}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-categories-restored_by',
            '{{%categories}}',
            'restored_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-categories-created_by',
            '{{%categories}}',
            'created_by'
        );

        $this->createIndex(
            'idx-categories-updated_by',
            '{{%categories}}',
            'updated_by'
        );

        $this->createIndex(
            'idx-categories-deleted_by',
            '{{%categories}}',
            'deleted_by'
        );

        $this->createIndex(
            'idx-categories-restored_by',
            '{{%categories}}',
            'restored_by'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-categories-created_by',
            '{{%categories}}'
        );

        $this->dropForeignKey(
            'fk-categories-updated_by',
            '{{%categories}}'
        );

        $this->dropForeignKey(
            'fk-categories-deleted_by',
            '{{%categories}}'
        );

        $this->dropForeignKey(
            'fk-categories-restored_by',
            '{{%categories}}'
        );

        $this->dropIndex(
            'idx-categories-created_by',
            '{{%categories}}'
        );

        $this->dropIndex(
            'idx-categories-updated_by',
            '{{%categories}}'
        );

        $this->dropIndex(
            'idx-categories-deleted_by',
            '{{%categories}}'
        );

        $this->dropIndex(
            'idx-categories-restored_by',
            '{{%categories}}'
        );

        $this->dropTable('{{%categories}}');
    }
}
