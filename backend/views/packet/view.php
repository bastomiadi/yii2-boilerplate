<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\v1\Packet $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="packet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="card mb-4" style="width: 40rem;">
    <h5 class="card-header"><?= Html::encode($model->packet_name) ?></h5>
    <div class="card-body">
        <?php if (!empty($model->packetsDetails)): ?>
            <ul class="list-group list-group-flush">
                <?php foreach ($model->packetsDetails as $packetDetail): ?>
                    <li class="list-group-item"> * <?= Html::encode($packetDetail->name_product_rsgh) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <br>
            <p class="card-text">
              <h3>  Rp. <?= Html::encode(number_format($model->total_price)) ?> </h3>
            </p>
        <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-primary">Update Packet</a>
        <a href="<?= Url::to(['offer', 'id' => $model->id]) ?>" class="btn btn-danger">Make Offer</a>
    </div>
    </div>

</div>
