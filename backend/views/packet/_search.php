<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\v1\search\PacketSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="packet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'packet_name') ?>

    <?= $form->field($model, 'total_price') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'discount_percent') ?>

    <?php // echo $form->field($model, 'discount_rupiah') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
