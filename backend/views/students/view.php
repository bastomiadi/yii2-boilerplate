<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\v1\Students */
?>
<div class="students-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sections',
            'classes',
            'name',
            'email:email',
            'address:ntext',
            'phone_number',
            'created_by',
            'updated_by',
            'deleted_by',
            'created_at',
            'updated_at',
            'deleted_at',
            'isDeleted',
            'restored_by',
            'restored_at',
        ],
    ]) ?>

</div>
