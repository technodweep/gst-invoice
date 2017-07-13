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
<!DOCTYPE html>
<html>
<head>
    <title></title>
<?php \yii\bootstrap\BootstrapPluginAsset::register($this);?>

</head>
<body>

<style>
@media all {
    body {
    font-family: Arial;
  background: #fff;
  font-size: 0.4cm;
}


table.main_table tr td {
    border-bottom: 1px solid #000;
}
table.main_table {
    width:20cm;
}
table.table tbody tr td {
    line-height: 1;
}
table.table {
    margin-top: 0;
    margin-bottom: 0;
}
table.table > tbody > tr > td.td_center {
     vertical-align: middle;
}
table.item_table tbody tr td {
    font-size: 0.35cm;
    padding: 0 10px;
    line-height: 0.65cm;
    border-right:1px solid #000;
}
table.item_table thead tr th {
    border:1px solid #000;
}
table.item_table{
    border-bottom:1px solid #000;
    border-top:1px solid #000;
    border-left:1px solid #000;
}
td.line-item-order{
    border-bottom:1px solid #000;
}
#footer_main{
    width:100%;
    margin: 20px auto 10px auto;
}
.footer_box1 {
    width:400px;
    margin-left:10px;
    margin-right:10px;
    margin-bottom:10px;
    float:left;
}
.footer_box2 {
    width:auto;
    float:right;
    margin-right:10px;
}
.div_item{
    margin:0 5px 7px 0;
}
table.toptable tbody tr td{
    border-top:0 none;
    padding: 0;
}
table.toptable{
    margin:10px 0 20px 0; 
}



}
@media print {
  body, page {
    margin: 0;
    display: block;
    box-shadow: 0;
  }
  #yii-debug-toolbar{
    display:none;
    visibility: hidden;
    height:0;
    overflow:hidden;
    width:0;
  }
}
</style>
<div style="padding:0 10px; ">
    <div style="min-height: 700px;">
        <div class="text-center"><h3 style="margin:0 0 20px 0;"><u>TAX INVOICE</u></h3></div>
        <table class="table toptable">
            <tbody>
                <tr>
                    <td width="45%" colspan="2">
                        <b><?= $model->customer->name ?></b><br>
                            <address style="margin: 5px 0;"><?= $model->btp_address ?></address>
                    </td>
                    <td>
                        <div class="div_item"><b>GST Invoice no:</b> <?= $model->gst_invoice_no ?></div>
                        <div class="div_item"><b>P.O. No:</b> <?= $model->po_no ?></div>
                        <div class="div_item"><b>Challan no:</b> <?= $model->challan_no ?></div>
                    </td>
                    <td><div class="div_item"><b>Date:</b> <?= date('d-m-Y',$model->gst_invoice_date) ?></div>
                        <div class="div_item"><b>Date:</b> <?= date('d-m-Y',$model->po_date) ?></div>
                        <div class="div_item"><b>Date:</b> <?= date('d-m-Y',$model->challan_date) ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><b>GSTIN:</b> <?= $model->btp_gstin ?></td>
                    <td colspan="2"><b>Mode of transport:</b> <?= $model->mode_of_transport ?></td>
                </tr>
            </tbody>
        </table>
        <table class="table item_table">
            <thead>
                <tr>
                    <th class="text-center">Sr.No</th>
                    <th width="50%">Description of item</th>
                    <th>HSN Code</th>
                    <th class="text-right">Rate</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Per</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; foreach ($model->invoiceOrderItems as $key => $o_item) { ?>
                <tr>
                    <td class="text-center line-item-order"><?= $i ?></td>
                    <td class="line-item-order"><?= $o_item->item_description ?></td>
                    <td class="line-item-order"><?= $o_item->product->hsn_code ?></td>
                    <td class="text-right line-item-order"><?= $o_item->item_rate ?></td>
                    <td class="text-center line-item-order"><?= $o_item->item_quantity ?></td>
                    <td class="text-right line-item-order"><?= $o_item->unit_measurement ?></td>
                    <td class="text-right line-item-order"><?= $o_item->item_total ?></td>
                </tr>
        <?php $i++; } ?>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="4" class="text-right">Add CGST (<?= $cgst_percent ?>%): </td>
                    <td class="text-right"><?= $model->cgst ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="4" class="text-right">Add SGST (<?= $sgst_percent ?>%): </td>
                    <td class="text-right"><?= $model->sgst ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="4" class="text-right">Add IGST (<?= $igst_percent ?>%): </td>
                    <td class="text-right"><?= $model->igst ?></td>
                </tr>
                <tr>
                    <td colspan="2">&nbsp;</td>
                    <td colspan="4" class="text-right">Total tax amount: </td>
                    <td class="text-right"><?= $model->total_tax_amount ?></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Rupees in words: </b><?= ucfirst(strtolower($model->amount_in_words)) ?></td>
                    <td colspan="4" class="text-right">Grand total: </td>
                    <td class="text-right"><b><?= $model->grabd_total ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="footer_main">
        <div class="row">
            <div class="footer_box1">
                <b>GST IN:</b> <?= $model->gst_in ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <b>PAN:</b> <?= $model->PAN ?></b><br>
                <small style="font-size:65%;">I hereby certify that my registration certificate under the GST Act 2017 is in force on the date on which the sale of goods specified in this tax invoice is made by me and the transaction of sale covered by this tax invoice has been effected by me and it shall be accounted for in the turnover of sales while filing of return and the due tax, if any payable on the sales has been paid or shall be paid.</small>

            </div>
            <div class="footer_box2">
                <h5 style="margin:0;" class="text-right">For Indiana rubber products</h5>
                <br><br>
                <div style="padding-top:10px;" class="text-right">
                    Proprietor/Manager
                </div>
            </div>
        </div>
    </div>
    



</div>

</body>
</html>
