<?php

use common\models\v1\Officer;
use dosamigos\tinymce\TinyMce;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

 $form = ActiveForm::begin(); ?>

    <?= $form->field($model_offer, 'to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_offer, 'regarding')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_offer, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_offer, 'content')->widget(TinyMce::className(), [
        'options' => ['rows' => 30],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>

    <?php echo $form->field($model_offer, 'officer')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(Officer::find()->orderBy(['name' => SORT_ASC])->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Select a Officer ...'],
        'pluginEvents' => [
            // "change" => 'function(data) { 
            //     var data_id = $(this).val();
            //     console.log(data_id);
            //     //$("input#target").val($(this).val());
            // }',
        ],
        'pluginOptions' => [
            'allowClear' => true,
            //'templateResult' => new JsExpression('formatData'),
            //'templateSelection' => new JsExpression('formatDataSelection')
        ],
    ]);
    ?>
  
    <div class="form-group">
        <?= Html::submitButton($model_offer->isNewRecord ? 'Create' : 'Update', ['class' => $model_offer->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>