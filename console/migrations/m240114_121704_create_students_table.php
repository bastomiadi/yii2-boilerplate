<?php
use yii\db\Migration;

/**
 * Handles the creation of table `{{%students}}`.
 */
class m240114_121704_create_students_table extends Migration
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

        $this->createTable('{{%students}}', [
            'id' => $this->bigPrimaryKey(),
            'sections' => $this->bigInteger()->notNull(),
            'classes' => $this->bigInteger()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'address' => $this->text()->notNull(),
            'phone_number' => $this->string(20)->notNull(),
            'created_by' => $this->bigInteger()->notNull(),
            'updated_by' => $this->bigInteger(),
            'deleted_by' => $this->bigInteger(),
            'created_at' => $this->bigInteger()->notNull(),
            'updated_at' => $this->bigInteger()->notNull(),
            'deleted_at' => $this->bigInteger(),
            'isDeleted' => $this->boolean()->notNull()->defaultValue(false),
            'restored_by' => $this->bigInteger()->null(),
            'restored_at' => $this->bigInteger(),
        ], $tableOptions);

        // add foreign key for table `sections`
        $this->addForeignKey(
            '{{%fk-students-sections}}',
            '{{%students}}',
            'sections',
            '{{%sections}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `classes`
        $this->addForeignKey(
            '{{%fk-students-classes}}',
            '{{%students}}',
            'classes',
            '{{%classes}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-created_by}}',
            '{{%students}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-updated_by}}',
            '{{%students}}',
            'updated_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            '{{%fk-students-deleted_by}}',
            '{{%students}}',
            'deleted_by',
            '{{%user}}',
            'id',
            'CASCADE',
            'CASCADE'
        );

        // create indexes
        $this->createIndex(
            '{{%idx-students-sections}}',
            '{{%students}}',
            'sections'
        );

        $this->createIndex(
            '{{%idx-students-classes}}',
            '{{%students}}',
            'classes'
        );

        $this->createIndex(
            '{{%idx-students-created_by}}',
            '{{%students}}',
            'created_by'
        );

        $this->createIndex(
            '{{%idx-students-updated_by}}',
            '{{%students}}',
            'updated_by'
        );

        $this->createIndex(
            '{{%idx-students-deleted_by}}',
            '{{%students}}',
            'deleted_by'
        );

        $this->createIndex(
            '{{%idx-students-restored_by}}',
            '{{%students}}',
            'restored_by'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drop foreign keys
        $this->dropForeignKey(
            '{{%fk-students-sections}}',
            '{{%students}}'
        );

        $this->dropForeignKey(
            '{{%fk-students-classes}}',
            '{{%students}}'
        );

        $this->dropForeignKey(
            '{{%fk-students-created_by}}',
            '{{%students}}'
        );

        $this->dropForeignKey(
            '{{%fk-students-updated_by}}',
            '{{%students}}'
        );

        $this->dropForeignKey(
            '{{%fk-students-deleted_by}}',
            '{{%students}}'
        );

        // drop indexes
        $this->dropIndex(
            '{{%idx-students-sections}}',
            '{{%students}}'
        );

        $this->dropIndex(
            '{{%idx-students-classes}}',
            '{{%students}}'
        );

        $this->dropIndex(
            '{{%idx-students-created_by}}',
            '{{%students}}'
        );

        $this->dropIndex(
            '{{%idx-students-updated_by}}',
            '{{%students}}'
        );

        $this->dropIndex(
            '{{%idx-students-deleted_by}}',
            '{{%students}}'
        );

        $this->dropIndex(
            '{{%idx-students-restored_by}}',
            '{{%students}}'
        );

        // drop table
        $this->dropTable('{{%students}}');
    }
}
