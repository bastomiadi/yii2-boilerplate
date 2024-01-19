<?php

use common\models\v1\Categories;
use common\models\v1\User;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
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
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'product_name',
    ],
    [
        'attribute' => 'category',
        'value' => function($model) {
            return $model->category0->category_name;
        },
        'filter' => ArrayHelper::map(Categories::find()->asArray()->all(), 'id', 'category_name'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => '-'],
            'pluginOptions' => [
                'allowClear' => true,
                'width'=> 'default'
            ],
        ],
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'deleted_at',
    ],
    [
        'attribute' => 'created_by',
        'value' => function($model) {
            return $model->createdBy->username;
        },
        'filter' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => [
                'allowClear' => true,
                'width'=> 'default'
            ],
        ],
    ],
    [
        'attribute' => 'updated_by',
        'value' => function($model) {
            return $model->updatedBy->username;
        },
        'filter' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => [
                'allowClear' => true,
                'width'=> 'default'
            ],
        ],
    ],
    [
        'attribute' => 'deleted_by',
        'value' => function($model) {
            return $model->deletedBy->username ?? $model->deletedBy;
        },
        'filter' => ArrayHelper::map(User::find()->asArray()->all(), 'id', 'username'),
        'filterType' => GridView::FILTER_SELECT2,
        'filterWidgetOptions' => [
            'options' => ['prompt' => ''],
            'pluginOptions' => [
                'allowClear' => true,
                'width'=> 'default'
            ],
        ],
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'deleted_by',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'isDeleted',
    // ],
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