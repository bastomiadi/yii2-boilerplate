<?php

use kartik\form\ActiveForm;
use kartik\grid\GridView;
use yii2ajaxcrud\ajaxcrud\BulkButtonWidget;
use yii2ajaxcrud\ajaxcrud\CrudAsset;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\v1\search\ProductsRsghSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products Rsghs';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<div class="products-rsgh-index">
    
    <div id="ajaxCrudDatatable">
        
        <div class="container">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
            
            <div class="row">
                <?= $form->field($model, 'file')->fileInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Upload', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        
        <?=GridView::widget([
            'id' => 'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax' => true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar' => [
                ['content'=>
                    Html::a(Yii::t('yii2-ajaxcrud', 'Create New'), ['create'],
                    ['role' => 'modal-remote', 'title' => Yii::t('yii2-ajaxcrud', 'Create New').' Products Rsghs', 'class' => 'btn btn-outline-primary']).
                    Html::a('<i class="fa fa-redo"></i>', [''],
                    ['data-pjax' => 1, 'class' => 'btn btn-outline-success', 'title' => Yii::t('yii2-ajaxcrud', 'Reset Grid')]).
                    '{toggleData}'.
                    '{export}'
                ],
            ],          
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'default', 
                'heading' => '<i class="fa fa-list"></i> <b>'.$this->title.'</b>',
                'before' =>'<em>* '.Yii::t('yii2-ajaxcrud', 'Resize Column').'</em>',
                'after' => BulkButtonWidget::widget([
                    'buttons' => Html::a('<i class="fa fa-trash"></i>&nbsp; '.Yii::t('yii2-ajaxcrud', 'Delete All'),
                        ["bulkdelete"] ,
                        [
                            'class' => 'btn btn-danger btn-xs',
                            'role' => 'modal-remote-bulk',
                            'data-confirm' => false,
                            'data-method' => false,// for overide yii data api
                            'data-request-method' => 'post',
                            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
                            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
                        ]),
                ]).                        
                '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
<?php Modal::begin([
    "id" => "ajaxCrudModal",
    "footer" => "", // always need it for jquery plugin
    "clientOptions" => [
        "tabindex" => false,
        "backdrop" => "static",
        "keyboard" => false,
    ],
    "options" => [
        "tabindex" => false
    ]
])?>
<?php Modal::end(); ?>
