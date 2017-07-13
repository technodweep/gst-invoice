<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Customers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Customers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Customers'.' '. Html::encode($this->title) ?></h2>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'address1',
        'address2',
        'city',
        'pincode',
        [
                'attribute' => 'state0.StateID',
                'label' => 'State'
            ],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
    
    <div class="row">
<?php
if($providerInvoiceOrder->totalCount){
    $gridColumnInvoiceOrder = [
        ['class' => 'yii\grid\SerialColumn'],
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
                'status',
    ];
    echo Gridview::widget([
        'dataProvider' => $providerInvoiceOrder,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => Html::encode('Invoice Order'),
        ],
        'panelHeadingTemplate' => '<h4>{heading}</h4>{summary}',
        'toggleData' => false,
        'columns' => $gridColumnInvoiceOrder
    ]);
}
?>
    </div>
</div>
