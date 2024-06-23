<?php

namespace common\models\v1;

use ruturajmaniyar\mod\audit\behaviors\AuditEntryBehaviors;
use yii2tech\ar\softdelete\SoftDeleteBehavior;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "{{%products_rsgh}}".
 *
 * @property string|null $MST_PRODUK_MPRO_KODE
 * @property string|null $NAMA_PRODUK
 * @property string|null $MPRO_PARENT
 * @property string|null $NAMA_PARENT
 * @property string|null $MPRO_ISGENERAL
 * @property string|null $REF_KATEGORI_PLY_RKPL_KODE
 * @property string|null $RKPL_NAMA
 * @property string|null $MPRO_ISGROUP
 * @property string|null $TIPE_TINDAKAN
 * @property string|null $REF_FRM_TND_RFTIND_KD
 * @property string|null $RFTIND_NAMA
 * @property string|null $MPRO_ISAKTIF
 * @property string|null $MPRO_IS_ADJUST_JSRS
 * @property string|null $MPRO_IS_ADJUST_JSBHP
 * @property string|null $MPRO_IS_ADJUST_JSALAT
 * @property string|null $MPRO_IS_ADJUST_JPOPERATOR
 * @property string|null $MPRO_IS_ADJUST_JPANESTHESI
 * @property string|null $MPRO_IS_ADJUST_JPPARAMEDIK
 * @property string|null $REF_JNS_TENAGAKERJA_KD
 * @property string|null $RJKTK_NAMA
 * @property string|null $REF_WAKTU_TIND_RWTIND_KODE
 * @property string|null $RWTIND_WAKTU_MULAI
 * @property string|null $RWTIND_WAKTU_SELESAI
 * @property string|null $REF_KOMP_TRF_INA_RKTINA_KODE
 * @property string|null $KOMPONEN_TARIF
 * @property string|null $MPRO_NAMA_EN
 * @property string|null $REF_KELAS_RLKS_KODE
 * @property string|null $RKLS_NAMA
 * @property string|null $MT_TGL_AWAL
 * @property string|null $MT_TGL_AKHIR
 * @property string|null $MT_JSRS
 * @property string|null $MT_JSBHP
 * @property string|null $MT_JSALAT
 * @property string|null $MT_JPOPERATOR
 * @property string|null $MT_JPANESTHESI
 * @property string|null $MT_JPPARAMEDIK
 * @property string|null $TOTAL_TARIF
 * @property string|null $MT_CATATAN
 * @property int $id
 * @property int $created_at
 * @property int $updated_at
 * @property int|null $deleted_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $deleted_by
 * @property int $isDeleted
 *
 * @property User $createdBy
 * @property User $deletedBy
 * @property PacketsDetail[] $packetsDetails
 * @property User $updatedBy
 */
class ProductsRsgh extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products_rsgh}}';
    }

     /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'blameable' => BlameableBehavior::class,
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'isDeleted' => true,
                    'deleted_at' => new Expression('unix_timestamp(NOW())'),
                    'deleted_by' => Yii::$app->user->identity->id ?? $this->deletedBy
                ],
                'replaceRegularDelete' => true // mutate native `delete()` method
            ],
            'auditEntryBehaviors' => [
                'class' => AuditEntryBehaviors::class
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'required', 'on' => 'upload'],
            [['file'], 'file', 'extensions' => 'xlsx', 'maxSize' => 1024 * 1024 * 5],
            [['created_at', 'updated_at', 'deleted_at', 'created_by', 'updated_by', 'deleted_by', 'isDeleted'], 'integer'],
            [['MST_PRODUK_MPRO_KODE', 'NAMA_PRODUK', 'MPRO_PARENT', 'NAMA_PARENT', 'MPRO_ISGENERAL', 'REF_KATEGORI_PLY_RKPL_KODE', 'RKPL_NAMA', 'MPRO_ISGROUP', 'TIPE_TINDAKAN', 'REF_FRM_TND_RFTIND_KD', 'RFTIND_NAMA', 'MPRO_ISAKTIF', 'MPRO_IS_ADJUST_JSRS', 'MPRO_IS_ADJUST_JSBHP', 'MPRO_IS_ADJUST_JSALAT', 'MPRO_IS_ADJUST_JPOPERATOR', 'MPRO_IS_ADJUST_JPANESTHESI', 'MPRO_IS_ADJUST_JPPARAMEDIK', 'REF_JNS_TENAGAKERJA_KD', 'RJKTK_NAMA', 'REF_WAKTU_TIND_RWTIND_KODE', 'RWTIND_WAKTU_MULAI', 'RWTIND_WAKTU_SELESAI', 'REF_KOMP_TRF_INA_RKTINA_KODE', 'KOMPONEN_TARIF', 'MPRO_NAMA_EN', 'REF_KELAS_RLKS_KODE', 'RKLS_NAMA', 'MT_TGL_AWAL', 'MT_TGL_AKHIR', 'MT_JSRS', 'MT_JSBHP', 'MT_JSALAT', 'MT_JPOPERATOR', 'MT_JPANESTHESI', 'MT_JPPARAMEDIK', 'TOTAL_TARIF', 'MT_CATATAN'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
            [['deleted_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['deleted_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'MST_PRODUK_MPRO_KODE' => 'Mst Produk Mpro Kode',
            'NAMA_PRODUK' => 'Nama Produk',
            'MPRO_PARENT' => 'Mpro Parent',
            'NAMA_PARENT' => 'Nama Parent',
            'MPRO_ISGENERAL' => 'Mpro Isgeneral',
            'REF_KATEGORI_PLY_RKPL_KODE' => 'Ref Kategori Ply Rkpl Kode',
            'RKPL_NAMA' => 'Rkpl Nama',
            'MPRO_ISGROUP' => 'Mpro Isgroup',
            'TIPE_TINDAKAN' => 'Tipe Tindakan',
            'REF_FRM_TND_RFTIND_KD' => 'Ref Frm Tnd Rftind Kd',
            'RFTIND_NAMA' => 'Rftind Nama',
            'MPRO_ISAKTIF' => 'Mpro Isaktif',
            'MPRO_IS_ADJUST_JSRS' => 'Mpro Is Adjust Jsrs',
            'MPRO_IS_ADJUST_JSBHP' => 'Mpro Is Adjust Jsbhp',
            'MPRO_IS_ADJUST_JSALAT' => 'Mpro Is Adjust Jsalat',
            'MPRO_IS_ADJUST_JPOPERATOR' => 'Mpro Is Adjust Jpoperator',
            'MPRO_IS_ADJUST_JPANESTHESI' => 'Mpro Is Adjust Jpanesthesi',
            'MPRO_IS_ADJUST_JPPARAMEDIK' => 'Mpro Is Adjust Jpparamedik',
            'REF_JNS_TENAGAKERJA_KD' => 'Ref Jns Tenagakerja Kd',
            'RJKTK_NAMA' => 'Rjktk Nama',
            'REF_WAKTU_TIND_RWTIND_KODE' => 'Ref Waktu Tind Rwtind Kode',
            'RWTIND_WAKTU_MULAI' => 'Rwtind Waktu Mulai',
            'RWTIND_WAKTU_SELESAI' => 'Rwtind Waktu Selesai',
            'REF_KOMP_TRF_INA_RKTINA_KODE' => 'Ref Komp Trf Ina Rktina Kode',
            'KOMPONEN_TARIF' => 'Komponen Tarif',
            'MPRO_NAMA_EN' => 'Mpro Nama En',
            'REF_KELAS_RLKS_KODE' => 'Ref Kelas Rlks Kode',
            'RKLS_NAMA' => 'Rkls Nama',
            'MT_TGL_AWAL' => 'Mt Tgl Awal',
            'MT_TGL_AKHIR' => 'Mt Tgl Akhir',
            'MT_JSRS' => 'Mt Jsrs',
            'MT_JSBHP' => 'Mt Jsbhp',
            'MT_JSALAT' => 'Mt Jsalat',
            'MT_JPOPERATOR' => 'Mt Jpoperator',
            'MT_JPANESTHESI' => 'Mt Jpanesthesi',
            'MT_JPPARAMEDIK' => 'Mt Jpparamedik',
            'TOTAL_TARIF' => 'Total Tarif',
            'MT_CATATAN' => 'Mt Catatan',
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
            'isDeleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * Gets query for [[DeletedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDeletedBy()
    {
        return $this->hasOne(User::class, ['id' => 'deleted_by']);
    }

    /**
     * Gets query for [[PacketsDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPacketsDetails()
    {
        return $this->hasMany(PacketsDetail::class, ['id_product_rsgh' => 'id']);
    }

    /**
     * Gets query for [[UpdatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
