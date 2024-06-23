<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\v1\ProductsRsgh */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-rsgh-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'MST_PRODUK_MPRO_KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_PRODUK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_PARENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'NAMA_PARENT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_ISGENERAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_KATEGORI_PLY_RKPL_KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RKPL_NAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_ISGROUP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TIPE_TINDAKAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_FRM_TND_RFTIND_KD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RFTIND_NAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_ISAKTIF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JSRS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JSBHP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JSALAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JPOPERATOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JPANESTHESI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_IS_ADJUST_JPPARAMEDIK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_JNS_TENAGAKERJA_KD')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RJKTK_NAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_WAKTU_TIND_RWTIND_KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RWTIND_WAKTU_MULAI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RWTIND_WAKTU_SELESAI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_KOMP_TRF_INA_RKTINA_KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'KOMPONEN_TARIF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MPRO_NAMA_EN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'REF_KELAS_RLKS_KODE')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'RKLS_NAMA')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_TGL_AWAL')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_TGL_AKHIR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JSRS')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JSBHP')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JSALAT')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JPOPERATOR')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JPANESTHESI')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_JPPARAMEDIK')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TOTAL_TARIF')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MT_CATATAN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'deleted_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'deleted_by')->textInput() ?>

    <?= $form->field($model, 'isDeleted')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
