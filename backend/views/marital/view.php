<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\v1\Marital */
?>
<div class="marital-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'marital_name',
            'created_at',
            'updated_at',
            'deleted_at',
            'created_by',
            'updated_by',
            'deleted_by',
            'isDeleted',
        ],
    ]) ?>

</div>
