<?php

use yii\helpers\Html;
use yii\web\User;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequest */

$this->title = 'Create Payment Request';
$this->params['breadcrumbs'][] = ['label' => 'Payment Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$myuserID = \Yii::$app->user->id;
$username = 'user id here';
?>
<div class="payment-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'user' => $username
    ]) ?>
 
</div>
