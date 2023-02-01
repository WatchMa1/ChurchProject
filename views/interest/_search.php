<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InterestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="interest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'other_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'residence') ?>

    <?php // echo $form->field($model, 'denomination') ?>

    <?php // echo $form->field($model, 'date') ?>

    <?php // echo $form->field($model, 'need') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
