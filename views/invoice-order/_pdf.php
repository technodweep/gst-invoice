<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceOrder */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Invoice Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Invoice Order'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'gst_in',
        'PAN',
        'gst_invoice_no',
        'gst_invoice_date',
        'challan_no',
        'challan_date',
        'po_no',
        'po_date',
        'mode_of_transport',
        'btp_address:ntext',
        [
                'attribute' => 'btpState.StateID',
                'label' => 'Btp State'
            ],
        'btp_code',
        'btp_gstin',
        'total_before_tax',
        'cgst',
        'sgst',
        'igst',
        'total_tax_amount',
        'total_amount_after_tax',
        'grabd_total',
        'amount_in_words',
        [
                'attribute' => 'customer.id',
                'label' => 'Customer'
            ],
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerInvoiceOrderItem->totalCount){
    $gridColumnInvoiceOrderItem = [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'id', 'visible' => false],
                [
                'attribute' => 'product.product_name',
                'label' => 'Product'
            ],
        'item_description',
        'item_quantity',
        'item_rate',
        'unit_measurement',
        'item_total',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceOrderItem,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Invoice Order Item'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInvoiceOrderItem
    ]);
}
?>
    </div>
</div>
