<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequest */

$this->title = 'Update Payment Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';

$model->date_required = date('Y-m-d',strtotime($model->date_required));
?>
<div class="payment-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>