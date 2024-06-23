<?php

use common\models\v1\PacketsDetail;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\v1\Packet $model */

$this->title = Yii::t('app', 'Update Packet: {name}', [
    'name' => $modelPacket->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $modelPacket->id, 'url' => ['view', 'id' => $modelPacket->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="packet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'modelPacket' => $modelPacket,
         'modelsDetailPacket' => (empty($modelsPacketDetail)) ? [new PacketsDetail] : $modelsPacketDetail
    ]) ?>

</div>
