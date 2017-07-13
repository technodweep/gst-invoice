<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TaxSettings */

$this->title = 'Update Tax Settings: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tax Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tax-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
