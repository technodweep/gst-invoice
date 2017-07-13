<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\InvoiceOrder */

?>
<div class="invoice-order-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= Html::encode($model->id) ?></h2>
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
        [
            'attribute' => 'customer.id',
            'label' => 'Customer',
        ],
        'status',
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]); 
?>
    </div>
</div>