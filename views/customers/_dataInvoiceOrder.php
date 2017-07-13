<?php
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

    $dataProvider = new ArrayDataProvider([
        'allModels' => $model->invoiceOrders,
        'key' => 'id'
    ]);
    $gridColumns = [
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
        [
            'class' => 'yii\grid\ActionColumn',
            'controller' => 'invoice-order'
        ],
    ];
    
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'containerOptions' => ['style' => 'overflow: auto'],
        'pjax' => true,
        'beforeHeader' => [
            [
                'options' => ['class' => 'skip-export']
            ]
        ],
        'export' => [
            'fontAwesome' => true
        ],
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'showPageSummary' => false,
        'persistResize' => false,
    ]);
