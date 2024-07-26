<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\v1\Profiles */
?>
<div class="profiles-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user',
            'first_name',
            'last_name',
            'phone_number',
            'address:ntext',
            'gender',
            'marital',
            'profile_image',
            'date_of_birth',
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
