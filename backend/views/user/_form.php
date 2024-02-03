<?php

use common\models\v1\AuthItem;
use common\models\v1\Genders;
use common\models\v1\Marital;
use common\models\v1\StatusUser;
use common\models\v1\User;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\v1\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(['options' => ['autocomplete' => 'off'],]); ?>

    <?php //form->field($model, 'username')->textInput(['maxlength' => true, 'readonly'=> $model->isNewRecord ? false : true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password',['inputOptions' => ['autocomplete' => 'off']])->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_repeat',['inputOptions' => ['autocomplete' => 'off']])->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($profiles, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profiles, 'date_of_birth')->widget(DateControl::class, [
        'type' => DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]);?>

    <?= $form->field($profiles, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profiles, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profiles, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($profiles, 'gender')->widget(Select2::class, [
        'data' => ArrayHelper::map(Genders::find()->all(), 'id','gender_name'),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'initialize' => true,
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($profiles, 'marital')->widget(Select2::class, [
        'data' => ArrayHelper::map(Marital::find()->all(), 'id','marital_name'),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'initialize' => true,
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'status')->widget(Select2::class, [
        'data' => ArrayHelper::map(StatusUser::find()->all(), 'id','status'),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'initialize' => true,
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($auth_assignment, 'item_name')->widget(Select2::class, [
        'data' => ArrayHelper::map(AuthItem::find()->where(['type'=>1])->all(), 'name','name'),
        //'language' => 'de',
        'options' => ['placeholder' => '...'],
        'pluginOptions' => [
            'initialize' => true,
            'allowClear' => true
        ],
    ]); ?>

	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
