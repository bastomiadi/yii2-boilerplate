<?php

use common\models\v1\Genders;
use common\models\v1\Marital;
use kartik\date\DatePicker;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\v1\Profiles */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Profile');
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);
?>

<div class="profiles-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'gender')->widget(Select2::class, [
        'data' => ArrayHelper::map(Genders::find()->all(), 'id','gender_name'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'marital')->widget(Select2::class, [
        'data' => ArrayHelper::map(Marital::find()->all(), 'id','marital_name'),
        'options' => ['placeholder' => 'Select ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= Html::img($model->profile_image, ['alt'=>'some', 'class'=>'thing']);?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'date_of_birth')->widget(DateControl::class, [
        'type' => DateControl::FORMAT_DATE,
        'saveFormat' => 'php:Y-m-d',
        'widgetOptions' => [
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]
    ]);?>

    <?php if (!Yii::$app->request->isAjax){ ?>
          <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    <?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>