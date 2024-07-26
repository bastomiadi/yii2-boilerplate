<?php

use common\models\v1\Classes;
use common\models\v1\Sections;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\v1\Students */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sections')->widget(Select2::class, [
        'data' => ArrayHelper::map(Sections::find()->all(), 'id',function($model){
            return 'Classes : ' . $model->classes0->name;
        }, function($model){
            return 'Section : ' . $model->name;
        }),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'classes')->widget(Select2::class, [
        'data' => ArrayHelper::map(Classes::find()->all(), 'id','name'),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
