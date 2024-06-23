<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m240622_021412_create_products_table extends Migration
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

        $this->createTable('{{%products_rsgh}}', [
            'MST_PRODUK_MPRO_KODE' => $this->string(255)->null(),
            'NAMA_PRODUK' => $this->string(255)->null(),
            'MPRO_PARENT' => $this->string(255)->null(),
            'NAMA_PARENT' => $this->string(255)->null(),
            'MPRO_ISGENERAL' => $this->string(255)->null(),
            'REF_KATEGORI_PLY_RKPL_KODE' => $this->string(255)->null(),
            'RKPL_NAMA' => $this->string(255)->null(),
            'MPRO_ISGROUP' => $this->string(255)->null(),
            'TIPE_TINDAKAN' => $this->string(255)->null(),
            'REF_FRM_TND_RFTIND_KD' => $this->string(255)->null(),
            'RFTIND_NAMA' => $this->string(255)->null(),
            'MPRO_ISAKTIF' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JSRS' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JSBHP' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JSALAT' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JPOPERATOR' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JPANESTHESI' => $this->string(255)->null(),
            'MPRO_IS_ADJUST_JPPARAMEDIK' => $this->string(255)->null(),
            'REF_JNS_TENAGAKERJA_KD' => $this->string(255)->null(),
            'RJKTK_NAMA' => $this->string(255)->null(),
            'REF_WAKTU_TIND_RWTIND_KODE' => $this->string(255)->null(),
            'RWTIND_WAKTU_MULAI' => $this->string(255)->null(),
            'RWTIND_WAKTU_SELESAI' => $this->string(255)->null(),
            'REF_KOMP_TRF_INA_RKTINA_KODE' => $this->string(255)->null(),
            'KOMPONEN_TARIF' => $this->string(255)->null(),
            'MPRO_NAMA_EN' => $this->string(255)->null(),
            'REF_KELAS_RLKS_KODE' => $this->string(255)->null(),
            'RKLS_NAMA' => $this->string(255)->null(),
            'MT_TGL_AWAL' =>$this->string(255)->null(),
            'MT_TGL_AKHIR' => $this->string(255)->null(),
            'MT_JSRS' => $this->string(255)->null(),
            'MT_JSBHP' => $this->string(255)->null(),
            'MT_JSALAT' => $this->string(255)->null(),
            'MT_JPOPERATOR' => $this->string(255)->null(),
            'MT_JPANESTHESI' => $this->string(255)->null(),
            'MT_JPPARAMEDIK' => $this->string(255)->null(),
            'TOTAL_TARIF' => $this->string(255)->null(),
            'MT_CATATAN' => $this->string(255)->null(),
            'id' => $this->bigPrimaryKey(),
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
        ],$tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products_rsgh}}');
    }
}
