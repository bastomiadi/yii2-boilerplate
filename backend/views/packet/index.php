<?php

use common\models\v1\Packet;
use kartik\form\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\v1\search\PacketSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Packets');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Packet'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $form = ActiveForm::begin([
        'method' => 'get',
    ]); ?>

    <div class="row">

    <div class="col-sm-6">
        <?= $form->field($searchModel, 'packet_name') ?>
    </div>
    
    <div class="col-sm-6">
        <?= $form->field($searchModel, 'description') ?>
    </div>
    
    </div>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::button('Reset', [
            'class' => 'btn btn-outline-secondary', 
            'onclick' => 'resetForm()'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'col-md-4'],
        'layout' => "<div class='row'>{items}</div>\n{pager}",
        'itemView' => function ($model, $key, $index, $widget) {
            return $this->render('_item', ['model' => $model]);
        },
        'pager' => [
            'options' => ['class' => 'pagination'], 
            'linkOptions' => ['class' => 'page-link'],
            'pageCssClass' => 'page-item',
            'disabledPageCssClass' => 'disabled',
        ],
    ]) ?>

    <?php Pjax::end(); ?>

</div>

<script>
    function resetForm() {
        var form = document.querySelector('.packet-index form');
        form.reset();
        window.location.href = form.action;
    }
</script>