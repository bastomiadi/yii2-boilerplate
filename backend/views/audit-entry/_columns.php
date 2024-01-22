<?php
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_timestamp',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_model_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_operation',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_field_name',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_old_value',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_new_value',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_user_id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'audit_entry_ip',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => 'true',
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'View'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-success'],
        'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Update'), 'data-toggle' => 'tooltip', 'class' => 'btn btn-sm btn-outline-primary'],
        'deleteOptions' => ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Delete'), 'class' => 'btn btn-sm btn-outline-danger', 
            'data-confirm' => false,
            'data-method' => false,// for overide yii data api
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm') ],
    ],

];   