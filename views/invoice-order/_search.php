<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="form-invoice-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

    <?= $form->field($model, 'gst_in')->textInput(['maxlength' => true, 'placeholder' => 'Gst In']) ?>

    <?= $form->field($model, 'PAN')->textInput(['maxlength' => true, 'placeholder' => 'PAN']) ?>

    <?= $form->field($model, 'gst_invoice_no')->textInput(['placeholder' => 'Gst Invoice No']) ?>

    <?= $form->field($model, 'gst_invoice_date')->textInput(['placeholder' => 'Gst Invoice Date']) ?>

    <?php /* echo $form->field($model, 'challan_no')->textInput(['placeholder' => 'Challan No']) */ ?>

    <?php /* echo $form->field($model, 'challan_date')->textInput(['placeholder' => 'Challan Date']) */ ?>

    <?php /* echo $form->field($model, 'po_no')->textInput(['placeholder' => 'Po No']) */ ?>

    <?php /* echo $form->field($model, 'po_date')->textInput(['placeholder' => 'Po Date']) */ ?>

    <?php /* echo $form->field($model, 'mode_of_transport')->textInput(['maxlength' => true, 'placeholder' => 'Mode Of Transport']) */ ?>

    <?php /* echo $form->field($model, 'btp_address')->textarea(['rows' => 6]) */ ?>

    <?php /* echo $form->field($model, 'btp_state')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\State::find()->orderBy('StateID')->asArray()->all(), 'StateID', 'StateID'),
        'options' => ['placeholder' => 'Choose State'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'btp_code')->textInput(['maxlength' => true, 'placeholder' => 'Btp Code']) */ ?>

    <?php /* echo $form->field($model, 'btp_gstin')->textInput(['maxlength' => true, 'placeholder' => 'Btp Gstin']) */ ?>

    <?php /* echo $form->field($model, 'total_before_tax')->textInput(['maxlength' => true, 'placeholder' => 'Total Before Tax']) */ ?>

    <?php /* echo $form->field($model, 'cgst')->textInput(['maxlength' => true, 'placeholder' => 'Cgst']) */ ?>

    <?php /* echo $form->field($model, 'sgst')->textInput(['maxlength' => true, 'placeholder' => 'Sgst']) */ ?>

    <?php /* echo $form->field($model, 'igst')->textInput(['maxlength' => true, 'placeholder' => 'Igst']) */ ?>

    <?php /* echo $form->field($model, 'total_tax_amount')->textInput(['maxlength' => true, 'placeholder' => 'Total Tax Amount']) */ ?>

    <?php /* echo $form->field($model, 'total_amount_after_tax')->textInput(['maxlength' => true, 'placeholder' => 'Total Amount After Tax']) */ ?>

    <?php /* echo $form->field($model, 'grabd_total')->textInput(['maxlength' => true, 'placeholder' => 'Grabd Total']) */ ?>

    <?php /* echo $form->field($model, 'amount_in_words')->textInput(['maxlength' => true, 'placeholder' => 'Amount In Words']) */ ?>

    <?php /* echo $form->field($model, 'customer_id')->widget(\kartik\widgets\Select2::classname(), [
        'data' => \yii\helpers\ArrayHelper::map(\app\models\Customers::find()->orderBy('id')->asArray()->all(), 'id', 'id'),
        'options' => ['placeholder' => 'Choose Customers'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); */ ?>

    <?php /* echo $form->field($model, 'status')->textInput(['placeholder' => 'Status']) */ ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
