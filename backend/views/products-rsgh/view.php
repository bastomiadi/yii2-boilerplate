<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\v1\ProductsRsgh */
?>
<div class="products-rsgh-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'MST_PRODUK_MPRO_KODE',
            'NAMA_PRODUK',
            'MPRO_PARENT',
            'NAMA_PARENT',
            'MPRO_ISGENERAL',
            'REF_KATEGORI_PLY_RKPL_KODE',
            'RKPL_NAMA',
            'MPRO_ISGROUP',
            'TIPE_TINDAKAN',
            'REF_FRM_TND_RFTIND_KD',
            'RFTIND_NAMA',
            'MPRO_ISAKTIF',
            'MPRO_IS_ADJUST_JSRS',
            'MPRO_IS_ADJUST_JSBHP',
            'MPRO_IS_ADJUST_JSALAT',
            'MPRO_IS_ADJUST_JPOPERATOR',
            'MPRO_IS_ADJUST_JPANESTHESI',
            'MPRO_IS_ADJUST_JPPARAMEDIK',
            'REF_JNS_TENAGAKERJA_KD',
            'RJKTK_NAMA',
            'REF_WAKTU_TIND_RWTIND_KODE',
            'RWTIND_WAKTU_MULAI',
            'RWTIND_WAKTU_SELESAI',
            'REF_KOMP_TRF_INA_RKTINA_KODE',
            'KOMPONEN_TARIF',
            'MPRO_NAMA_EN',
            'REF_KELAS_RLKS_KODE',
            'RKLS_NAMA',
            'MT_TGL_AWAL',
            'MT_TGL_AKHIR',
            'MT_JSRS',
            'MT_JSBHP',
            'MT_JSALAT',
            'MT_JPOPERATOR',
            'MT_JPANESTHESI',
            'MT_JPPARAMEDIK',
            'TOTAL_TARIF',
            'MT_CATATAN',
            'id',
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'isDeleted',
        ],
    ]) ?>

</div>
