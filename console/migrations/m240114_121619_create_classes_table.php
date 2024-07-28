<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%classes}}`.
 */
class m240114_121619_create_classes_table extends Migration
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

        $this->createTable('{{%classes}}', [
            'id' => $this->bigPrimaryKey(),
            'name' => $this->string()->notNull(),
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

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-created_by}}',
            '{{%classes}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-updated_by}}',
            '{{%classes}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-deleted_by}}',
            '{{%classes}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-classes-restored_by}}',
            '{{%classes}}',
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
            '{{%fk-classes-created_by}}',
            '{{%classes}}'
        );

        $this->dropForeignKey(
            '{{%fk-classes-updated_by}}',
            '{{%classes}}'
        );

        $this->dropForeignKey(
            '{{%fk-classes-deleted_by}}',
            '{{%classes}}'
        );

        $this->dropForeignKey(
            '{{%fk-classes-restored_by}}',
            '{{%classes}}'
        );

        $this->dropTable('{{%classes}}');
    }
}

