<?php

use common\models\v1\ProductsRsgh;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use Yii2\Extensions\DynamicForm\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\web\View;

/** @var yii\web\View $this */
/** @var common\models\v1\Packet $model */
/** @var yii\widgets\ActiveForm $form */

/* @var $this yii\web\View */
/* @var $modelCustomer app\modules\yii2extensions\models\Customer */
/* @var $modelsDetailPacket app\modules\yii2extensions\models\Address */

// $js = '
// jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
//     jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
//         jQuery(this).html("Product: " + (index + 1))
//         //console.log(index);
//     });
// });

// jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
//     jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
//         jQuery(this).html("Product: " + (index + 1))
//     });
// });
// ';

// $this->registerJs($js);

// $data = [
//     ['id' => '1', 'text' => 'Option 1', 'description' => 'This is option 1'],
//     ['id' => '2', 'text' => 'Option 2', 'description' => 'This is option 2'],
//     ['id' => '3', 'text' => 'Option 3', 'description' => 'This is option 3']
// ];

// // Encode the data as a JSON string
// $jsonData = json_encode($data);

// $this->registerJsVar('data', $jsonData, View::POS_HEAD);

// // JavaScript for custom templates
// $customScript = <<<JS
// function formatData(data) {
//     if (!data.id) {
//         return data.text;
//     }
//     var \$data = \$(
//         '<div><strong>' + data.id + '</strong><br><small>' + data.description + '</small></div>'
//     );
//     return \$data;
// }

// function formatDataSelection(data) {
//     return data.text;
// }
// JS;

// $this->registerJs($customScript, View::POS_HEAD);
?>

<div class="packet-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="card mb-3"><!-- widgetBody -->
        <div class="card-header">
            <h5 class="card-title">Paket</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($modelPacket, 'packet_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelPacket, 'description')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 999, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsDetailPacket[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'id_product_rsgh',
                    'name_product_rsgh',
                    'normal_price',
                    'custom_price',
                ],
            ]); ?>

            <!-- <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Product</button> -->

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelsDetailPacket as $index => $modelDetailPacket): ?>
                    <div class="item card mb-3"><!-- widgetBody -->
                        <div class="card-header">
                            <h5 class="card-title">Product Item : <?= ($index + 1) ?></h5>
                            <div class="card-tools">
                                <button type="button" class="btn btn-success btn-xs add-item"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-danger btn-xs remove-item"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                // necessary for update action.
                                if (!$modelDetailPacket->isNewRecord) {
                                    echo Html::activeHiddenInput($modelDetailPacket, "[{$index}]id");
                                }
                            ?>
                            <div class="row">
                                <div class="col-sm-3">
                                <?php echo $form->field($modelDetailPacket, "[{$index}]id_product_rsgh")->widget(Select2::classname(), [
                                    'data' => ArrayHelper::map(ProductsRsgh::find()->orderBy(['created_at' => SORT_DESC, 'id'=> SORT_DESC])->all(), 'id','NAMA_PRODUK'),
                                    //'data' => $data,
                                    'options' => ['placeholder' => 'Select a Product ...', 'class'=>'dynamic-product-id'],
                                    'pluginEvents' => [
                                        "change" => 'function(data) { 
                                            var data_id = $(this).val();
                                            console.log(data_id);
                                            //$("input#target").val($(this).val());
                                        }',
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                        //'templateResult' => new JsExpression('formatData'),
                                        //'templateSelection' => new JsExpression('formatDataSelection')
                                    ],
                                ]);
                                ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelDetailPacket, "[{$index}]name_product_rsgh")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelDetailPacket, "[{$index}]normal_price")->textInput(['maxlength' => true, 'readonly' => true]) ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelDetailPacket, "[{$index}]custom_price")->textInput(['maxlength' => true]) ?>
                                </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                
            </div>
            
            <?php DynamicFormWidget::end(); ?>

            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($modelPacket, 'discount_percent')->textInput(['maxlength' => true, 'id' => 'discount-percent']) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelPacket, 'discount_rupiah')->textInput(['maxlength' => true, 'id' => 'discount-price']) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    
                </div>
                <div class="col-sm-6">
                    <?= $form->field($modelPacket, 'total_price')->textInput(['maxlength' => true, 'id' => 'total-price']) ?>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($modelDetailPacket->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    

    <?php ActiveForm::end(); ?>

</div>

<?php

$fetchProductDetail = Url::to(['products-rsgh/get-product-detail']);

$script = <<< JS
$(document).ready(function () {

    function calculateTotalPrice() {
        var totalPrice = 0;
        $('.container-items .item').each(function() {
            var price = parseFloat($(this).find('input[name*="[custom_price]"]').val()) || 0;
            // var quantity = parseInt($(this).find('input[name*="[quantity]"]').val()) || 0;
            // totalPrice += price * quantity;
            totalPrice += price;
        });

        var discountPercent = parseFloat($('#discount-percent').val()) || 0;
        var discountPrice = parseFloat($('#discount-price').val()) || 0;

        var finalDiscountPrice = 0;

        if (discountPercent > 0 && discountPrice > 0) {
            // Both discount percent and discount price are filled, use both for calculation
            var percentDiscountAmount = totalPrice * discountPercent / 100;
            finalDiscountPrice = Math.min(percentDiscountAmount, discountPrice);
        } else if (discountPrice > 0) {
            // Only discount price is filled
            finalDiscountPrice = discountPrice;
        } else if (discountPercent > 0) {
            // Only discount percent is filled
            finalDiscountPrice = totalPrice * discountPercent / 100;
        }

        var finalTotalPrice = totalPrice - finalDiscountPrice;
        $('#total-price').val(finalTotalPrice);
    }
    
    $('.dynamicform_wrapper').on('afterInsert', function(e, item) {
        
        // $(item).find('.dynamic-product-id').change(function() {
        //     fetchProductPrice($(this));
        // });
        
        var productDropdown = $(item).find('.dynamic-product-id');
        
        // Bind change event to newly inserted product dropdown
        productDropdown.change(function() {
            fetchProductPrice($(this)); // Fetch and update price when product is selected
        });

        // Calculate total price when quantity changes
        $(item).find('input[name*="[custom_price]"]').on('input', function() {
            calculateTotalPrice(); // Recalculate total price on quantity change
        });

        // Update order item numbers
        updateOrderItemNumbers();

        // Trigger initial price calculation for newly inserted item
        fetchProductPrice(productDropdown);
    });

    $('.dynamicform_wrapper').on('afterDelete', function(e, item) {
        
        var productDropdown = $(item).find('.dynamic-product-id');
        
        // Bind change event to newly inserted product dropdown
        productDropdown.change(function() {
            fetchProductPrice($(this)); // Fetch and update price when product is selected
        });

        // Calculate total price when quantity changes
        $(item).find('input[name*="[custom_price]"]').on('input', function() {
            calculateTotalPrice(); // Recalculate total price on quantity change
        });

        // Trigger initial price calculation for newly inserted item
        fetchProductPrice(productDropdown);
    });

    $('.dynamic-product-id').change(function() {
        fetchProductPrice($(this));
    });

    function fetchProductPrice(element) {
        var productId = element.val();
        var priceField = element.closest('.item').find('input[name*="[normal_price]"]');
        var nameField = element.closest('.item').find('input[name*="[name_product_rsgh]"]');
        var customPriceField = element.closest('.item').find('input[name*="[custom_price]"]');
        
        if (productId) {
            $.ajax({
                url: '$fetchProductDetail',
                type: 'GET',
                data: {id: productId},
                success: function (data) {
                    console.log(data);
                    priceField.val(data.TOTAL_TARIF);
                    nameField.val(data.NAMA_PRODUK);
                    customPriceField.val(data.TOTAL_TARIF);
                    calculateTotalPrice(); // Recalculate total price after price update
                }
            });
        } else {
            priceField.val('');
            calculateTotalPrice();
        }
    }

    $('#discount-percent, #discount-price').on('input', function() {
        calculateTotalPrice();
    });

    // Bind input event to quantity and price fields for existing items
    $('.container-items').find('input[name*="[custom_price]"]').on('input', function() {
        calculateTotalPrice(); // Recalculate total price on input change
    });

    $(".dynamicform_wrapper").on("limitReached", function(e, item) {
        alert("Limit reached");
    });

    $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
        if (! confirm("Are you sure you want to delete this item?")) {
            return false;
        }
        return true;
    });

    $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
        console.log("beforeInsert");
    });

    // Function to update order item numbers
    function updateOrderItemNumbers() {
        $('.container-items .item').each(function(index) {
            $(this).find('.card-title').text('Product Item : ' + (index + 1));
        });
    }
    
    // Initial calculation
    calculateTotalPrice();

     // Update order item numbers on document ready
     updateOrderItemNumbers();
});
JS;
$this->registerJs($script);
?>