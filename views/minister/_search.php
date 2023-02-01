<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MinisterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="minister-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'minister_id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'other_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'address_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
