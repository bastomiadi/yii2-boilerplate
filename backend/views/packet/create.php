<?php

use common\models\v1\ProductsRsgh;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\v1\Packet $model */

$this->title = Yii::t('app', 'Create Packet');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Packets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'modelPacket' => $modelPacket,
        'modelsDetailPacket' => (empty($modelsDetailPacket)) ? [new ProductsRsgh] : $modelsDetailPacket
    ]) ?>

</div>
