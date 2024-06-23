<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%seed_officers}}`.
 */
class m240623_110103_create_seed_officers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%officers}}', ['name', 'initials', 'stamp', 'created_at','updated_at','deleted_at', 'created_by','updated_by','deleted_by','isDeleted',], [
            ['Helmi Adi Wibowo, SE','','', new Expression('unix_timestamp(NOW())'), new Expression('unix_timestamp(NOW())'), NULL, 1, 1, NULL, 0],
            ['Chinta Dwi Pramesti, S.Sos','','', new Expression('unix_timestamp(NOW())'), new Expression('unix_timestamp(NOW())'), NULL, 1, 1, NULL, 0],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return false;
        // $this->dropTable('{{%seed_officers}}');
    }
}
