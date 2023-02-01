<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OfferingAndTithe */


$this->title = 'Update Offering And Tithe: ' . $model->receipt_id;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Offering And Tithes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->receipt_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$model->date_of_receipt = date("Y-m-d",$model->date_of_receipt)
?>
<div class="offering-and-tithe-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'year' => $year,
    ]) ?>

</div>