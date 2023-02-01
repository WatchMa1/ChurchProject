<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'requested_by') ?>

    <?= $form->field($model, 'department') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'strategic_area') ?>

    <?php // echo $form->field($model, 'date_required') ?>

    <?php // echo $form->field($model, 'payment_to_be_made_to') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'requested_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
