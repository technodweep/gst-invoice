<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TaxSettings */

$this->title = 'Save As New Tax Settings: '. ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tax Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Save As New';
?>
<div class="tax-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
    'model' => $model,
    ]) ?>

</div>
