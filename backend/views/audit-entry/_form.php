<?php
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\v1\AuditEntry */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="audit-entry-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'audit_entry_timestamp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audit_entry_model_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audit_entry_operation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audit_entry_field_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audit_entry_old_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'audit_entry_new_value')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'audit_entry_user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'audit_entry_ip')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
