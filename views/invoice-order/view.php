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
        <div class="col-sm-6">
            <h2><?= 'Invoice Order'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-6" style="margin-top: 15px">
<?=             
             Html::a('<i class="fa glyphicon glyphicon-hand-up"></i> ' . 'PDF', 
                ['pdf', 'id' => $model->id],
                [
                    'class' => 'btn btn-danger',
                    'target' => '_blank',
                    'data-toggle' => 'tooltip',
                    'title' => 'Will open the generated PDF file in a new window'
                ]
            )?>
            <?= Html::a('Print', ['print', 'id' => $model->id], ['class' => 'btn btn-info', 'target' => '_blank']) ?> 
            <?= Html::a('Save As New', ['save-as-new', 'id' => $model->id], ['class' => 'btn btn-info']) ?>            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        [
            'attribute' => 'customer.name',
            'label' => 'Customer',
        ],
        'gst_in',
        'PAN',
        'gst_invoice_no',
        'gst_invoice_date:date',
        'challan_no',
        'challan_date:date',
        'po_no',
        'po_date:date',
        'mode_of_transport',
        'btp_address:html',
        [
            'attribute' => 'btpState.StateID',
            'label' => 'Btp State',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice-order-item']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Invoice Order Item'),
        ],
        'columns' => $gridColumnInvoiceOrderItem
    ]);
}
?>
    </div>
</div>
