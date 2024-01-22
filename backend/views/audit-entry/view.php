<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\v1\AuditEntry */
?>
<div class="audit-entry-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'audit_entry_id',
            'audit_entry_timestamp',
            'audit_entry_model_name',
            'audit_entry_operation',
            'audit_entry_field_name',
            'audit_entry_old_value:ntext',
            'audit_entry_new_value:ntext',
            'audit_entry_user_id',
            'audit_entry_ip',
        ],
    ]) ?>

</div>
