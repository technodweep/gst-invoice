<div class="form-group" id="add-invoice-order">
<?php
use kartik\grid\GridView;
use kartik\builder\TabularForm;
use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use yii\widgets\Pjax;

$dataProvider = new ArrayDataProvider([
    'allModels' => $row,
    'pagination' => [
        'pageSize' => -1
    ]
]);
echo TabularForm::widget([
    'dataProvider' => $dataProvider,
    'formName' => 'InvoiceOrder',
    'checkboxColumn' => false,
    'actionColumn' => false,
    'attributeDefaults' => [
        'type' => TabularForm::INPUT_TEXT,
    ],
    'attributes' => [
        "id" => ['type' => TabularForm::INPUT_HIDDEN, 'visible' => false],
        'gst_in' => ['type' => TabularForm::INPUT_TEXT],
        'PAN' => ['type' => TabularForm::INPUT_TEXT],
        'gst_invoice_no' => ['type' => TabularForm::INPUT_TEXT],
        'gst_invoice_date' => ['type' => TabularForm::INPUT_TEXT],
        'challan_no' => ['type' => TabularForm::INPUT_TEXT],
        'challan_date' => ['type' => TabularForm::INPUT_TEXT],
        'po_no' => ['type' => TabularForm::INPUT_TEXT],
        'po_date' => ['type' => TabularForm::INPUT_TEXT],
        'mode_of_transport' => ['type' => TabularForm::INPUT_TEXT],
        'btp_address' => ['type' => TabularForm::INPUT_TEXTAREA],
        'btp_state' => [
            'label' => 'State',
            'type' => TabularForm::INPUT_WIDGET,
            'widgetClass' => \kartik\widgets\Select2::className(),
            'options' => [
                'data' => \yii\helpers\ArrayHelper::map(\app\models\State::find()->orderBy('StateID')->asArray()->all(), 'StateID', 'StateID'),
                'options' => ['placeholder' => 'Choose State'],
            ],
            'columnOptions' => ['width' => '200px']
        ],
        'btp_code' => ['type' => TabularForm::INPUT_TEXT],
        'btp_gstin' => ['type' => TabularForm::INPUT_TEXT],
        'total_before_tax' => ['type' => TabularForm::INPUT_TEXT],
        'cgst' => ['type' => TabularForm::INPUT_TEXT],
        'sgst' => ['type' => TabularForm::INPUT_TEXT],
        'igst' => ['type' => TabularForm::INPUT_TEXT],
        'total_tax_amount' => ['type' => TabularForm::INPUT_TEXT],
        'total_amount_after_tax' => ['type' => TabularForm::INPUT_TEXT],
        'grabd_total' => ['type' => TabularForm::INPUT_TEXT],
        'amount_in_words' => ['type' => TabularForm::INPUT_TEXT],
        'status' => ['type' => TabularForm::INPUT_TEXT],
        'del' => [
            'type' => 'raw',
            'label' => '',
            'value' => function($model, $key) {
                return
                    Html::hiddenInput('Children[' . $key . '][id]', (!empty($model['id'])) ? $model['id'] : "") .
                    Html::a('<i class="glyphicon glyphicon-trash"></i>', '#', ['title' =>  'Delete', 'onClick' => 'delRowInvoiceOrder(' . $key . '); return false;', 'id' => 'invoice-order-del-btn']);
            },
        ],
    ],
    'gridSettings' => [
        'panel' => [
            'heading' => false,
            'type' => GridView::TYPE_DEFAULT,
            'before' => false,
            'footer' => false,
            'after' => Html::button('<i class="glyphicon glyphicon-plus"></i>' . 'Add Invoice Order', ['type' => 'button', 'class' => 'btn btn-success kv-batch-create', 'onClick' => 'addRowInvoiceOrder()']),
        ]
    ]
]);
echo  "    </div>\n\n";
?>

