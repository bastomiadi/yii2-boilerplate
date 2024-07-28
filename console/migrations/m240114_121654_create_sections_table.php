<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%sections}}`.
 */
class m240114_121654_create_sections_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // MySQL specific table options
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sections}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull(),
            'classes' => $this->bigInteger()->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->integer()->notNull()->defaultValue(0),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ], $tableOptions);

        // add foreign key for table `classes`
        $this->addForeignKey(
            '{{%fk-sections-classes}}',
            '{{%sections}}',
            'classes',
            '{{%classes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-created_by}}',
            '{{%sections}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-updated_by}}',
            '{{%sections}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-deleted_by}}',
            '{{%sections}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-sections-restored_by}}',
            '{{%sections}}',
            'restored_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-sections-classes}}',
            '{{%sections}}'
        );

        $this->dropForeignKey(
            '{{%fk-sections-created_by}}',
            '{{%sections}}'
        );

        $this->dropForeignKey(
            '{{%fk-sections-updated_by}}',
            '{{%sections}}'
        );

        $this->dropForeignKey(
            '{{%fk-sections-deleted_by}}',
            '{{%sections}}'
        );

        $this->dropForeignKey(
            '{{%fk-sections-restored_by}}',
            '{{%sections}}'
        );

        $this->dropTable('{{%sections}}');
    }
}

