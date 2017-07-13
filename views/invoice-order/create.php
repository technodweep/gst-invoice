<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\InvoiceOrder */

$this->title = 'Create Invoice Order';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'cgst_percent' => $cgst_percent,
        'sgst_percent' => $sgst_percent,
        'igst_percent' => $igst_percent,
    ]) ?>

</div>
