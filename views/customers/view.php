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
        <div class="col-sm-8">
            <h2><?= 'Customers'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-4" style="margin-top: 15px">
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
        'name',
        'gstin',
        'address1',
        'address2',
        'city',
        'pincode',
        [
            'attribute' => 'state0.StateID',
            'label' => 'State',
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
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-invoice-order']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Invoice Order'),
        ],
        'columns' => $gridColumnInvoiceOrder
    ]);
}
?>
    </div>
</div>
