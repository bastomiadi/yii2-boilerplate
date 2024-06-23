<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\v1\search\ProductsRsghSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="products-rsgh-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'MST_PRODUK_MPRO_KODE') ?>

    <?= $form->field($model, 'NAMA_PRODUK') ?>

    <?= $form->field($model, 'MPRO_PARENT') ?>

    <?= $form->field($model, 'NAMA_PARENT') ?>

    <?= $form->field($model, 'MPRO_ISGENERAL') ?>

    <?php // echo $form->field($model, 'REF_KATEGORI_PLY_RKPL_KODE') ?>

    <?php // echo $form->field($model, 'RKPL_NAMA') ?>

    <?php // echo $form->field($model, 'MPRO_ISGROUP') ?>

    <?php // echo $form->field($model, 'TIPE_TINDAKAN') ?>

    <?php // echo $form->field($model, 'REF_FRM_TND_RFTIND_KD') ?>

    <?php // echo $form->field($model, 'RFTIND_NAMA') ?>

    <?php // echo $form->field($model, 'MPRO_ISAKTIF') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JSRS') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JSBHP') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JSALAT') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JPOPERATOR') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JPANESTHESI') ?>

    <?php // echo $form->field($model, 'MPRO_IS_ADJUST_JPPARAMEDIK') ?>

    <?php // echo $form->field($model, 'REF_JNS_TENAGAKERJA_KD') ?>

    <?php // echo $form->field($model, 'RJKTK_NAMA') ?>

    <?php // echo $form->field($model, 'REF_WAKTU_TIND_RWTIND_KODE') ?>

    <?php // echo $form->field($model, 'RWTIND_WAKTU_MULAI') ?>

    <?php // echo $form->field($model, 'RWTIND_WAKTU_SELESAI') ?>

    <?php // echo $form->field($model, 'REF_KOMP_TRF_INA_RKTINA_KODE') ?>

    <?php // echo $form->field($model, 'KOMPONEN_TARIF') ?>

    <?php // echo $form->field($model, 'MPRO_NAMA_EN') ?>

    <?php // echo $form->field($model, 'REF_KELAS_RLKS_KODE') ?>

    <?php // echo $form->field($model, 'RKLS_NAMA') ?>

    <?php // echo $form->field($model, 'MT_TGL_AWAL') ?>

    <?php // echo $form->field($model, 'MT_TGL_AKHIR') ?>

    <?php // echo $form->field($model, 'MT_JSRS') ?>

    <?php // echo $form->field($model, 'MT_JSBHP') ?>

    <?php // echo $form->field($model, 'MT_JSALAT') ?>

    <?php // echo $form->field($model, 'MT_JPOPERATOR') ?>

    <?php // echo $form->field($model, 'MT_JPANESTHESI') ?>

    <?php // echo $form->field($model, 'MT_JPPARAMEDIK') ?>

    <?php // echo $form->field($model, 'TOTAL_TARIF') ?>

    <?php // echo $form->field($model, 'MT_CATATAN') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
