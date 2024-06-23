<?php
// views/item/_item.php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="card mb-4">
<h5 class="card-header"><?= Html::encode($model->packet_name) ?></h5>
  <div class="card-body">
    <?php if (!empty($model->packetsDetails)): ?>
        <ul class="list-group list-group-flush">
            <?php foreach ($model->packetsDetails as $packetDetail): ?>
                <li class="list-group-item"><?= Html::encode($packetDetail->name_product_rsgh) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <br>
    <p class="card-text">Rp. <?= Html::encode($model->total_price) ?></p>
    <br>
    <a href="<?= Url::to(['update', 'id' => $model->id]) ?>" class="btn btn-primary">Update Packet</a>
    <a href="<?= Url::to(['offer', 'id' => $model->id]) ?>" class="btn btn-danger">Make Offer</a>
  </div>
</div>