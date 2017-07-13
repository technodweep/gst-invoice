<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceOrder */
/* @var $form yii\widgets\ActiveForm */

\mootensai\components\JsBlock::widget(['viewFile' => '_script', 'pos'=> \yii\web\View::POS_END, 
    'viewParams' => [
        'class' => 'InvoiceOrderItem', 
        'relID' => 'invoice-order-item', 
        'value' => \yii\helpers\Json::encode($model->invoiceOrderItems),
        'isNewRecord' => ($model->isNewRecord) ? 1 : 0
    ]
]);
?>

<div class="invoice-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'customer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Customers::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
        'options' => ['placeholder' => 'Choose Customers', 'onchange' => 'td_load_customer_data_to_createorder(this.value);'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'btp_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'btp_state')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\State::find()->orderBy('StateID')->asArray()->all(), 'StateID', 'StateName'),
        'options' => ['placeholder' => 'Choose State'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'btp_code')->textInput(['maxlength' => true, 'placeholder' => 'Btp Code']) ?>

    <?= $form->field($model, 'btp_gstin')->textInput(['maxlength' => true, 'placeholder' => 'Btp Gstin']) ?>

    <?= $form->field($model, 'gst_in')->textInput(['maxlength' => true, 'placeholder' => 'Gst In']) ?>

    <?= $form->field($model, 'PAN')->textInput(['maxlength' => true, 'placeholder' => 'PAN']) ?>

    <?= $form->field($model, 'gst_invoice_no')->textInput(['placeholder' => 'Gst Invoice No']) ?>

    <?= $form->field($model, 'gst_invoice_date')->widget(kartik\date\DatePicker::classname(),[
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'autoclose'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'challan_no')->textInput(['placeholder' => 'Challan No']) ?>

    <?= $form->field($model, 'challan_date')->widget(kartik\date\DatePicker::classname(),[
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'autoclose'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'po_no')->textInput(['placeholder' => 'Po No']) ?>

    <?= $form->field($model, 'po_date')->widget(kartik\date\DatePicker::classname(),[
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'autoclose'=>true
        ]
    ]) ?>

    <?= $form->field($model, 'mode_of_transport')->textInput(['maxlength' => true, 'placeholder' => 'Mode of transport']) ?>

    <?php
    $forms = [
        [
            'label' => '<i class="glyphicon glyphicon-book"></i> ' . Html::encode('InvoiceOrderItem'),
            'content' => $this->render('_formInvoiceOrderItem', [
                'row' => \yii\helpers\ArrayHelper::toArray($model->invoiceOrderItems),
            ]),
        ],
    ];
    echo kartik\tabs\TabsX::widget([
        'items' => $forms,
        'position' => kartik\tabs\TabsX::POS_ABOVE,
        'encodeLabels' => false,
        'pluginOptions' => [
            'bordered' => true,
            'sideways' => true,
            'enableCache' => false,
        ],
    ]);
    ?>

    <?= $form->field($model, 'total_before_tax')->textInput(['maxlength' => true, 'placeholder' => 'Total Before Tax']) ?><input type="button" name="calculate" id="td_calculate" value="Calculate">

    <?= $form->field($model, 'cgst')->textInput(['maxlength' => true, 'placeholder' => 'Cgst']) ?>

    <?= $form->field($model, 'sgst')->textInput(['maxlength' => true, 'placeholder' => 'Sgst']) ?>

    <?= $form->field($model, 'igst')->textInput(['maxlength' => true, 'placeholder' => 'Igst']) ?>

    <?= $form->field($model, 'total_tax_amount')->textInput(['maxlength' => true, 'placeholder' => 'Total Tax Amount', 'data-cgst' => $cgst_percent, 'data-sgst' => $sgst_percent, 'data-igst' => $igst_percent]) ?>

    <?= $form->field($model, 'total_amount_after_tax')->textInput(['maxlength' => true, 'placeholder' => 'Total Amount After Tax']) ?>

    <?= $form->field($model, 'grabd_total')->textInput(['maxlength' => true, 'placeholder' => 'Grabd Total']) ?>

    <?= $form->field($model, 'amount_in_words')->textInput(['maxlength' => true, 'placeholder' => 'Amount In Words']) ?>

    <?= $form->field($model, 'status')->dropdownList([
        1 => 'Active', 
        0 => 'Inactive'
    ]) ?>

    
    <div class="form-group">
    <?php if(Yii::$app->controller->action->id != 'save-as-new'): ?>
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <?php endif; ?>
    <?php if(Yii::$app->controller->action->id != 'create'): ?>
        <?= Html::submitButton('Save As New', ['class' => 'btn btn-info', 'value' => '1', 'name' => '_asnew']) ?>
    <?php endif; ?>
        <?= Html::a(Yii::t('app', 'Cancel'), Yii::$app->request->referrer , ['class'=> 'btn btn-danger']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
