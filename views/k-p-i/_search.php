<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\KPISearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kpi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'measure') ?>

    <?= $form->field($model, 'yearly_target') ?>

    <?= $form->field($model, 'q1_target') ?>

    <?= $form->field($model, 'q2_target') ?>

    <?php // echo $form->field($model, 'q3_target') ?>

    <?php // echo $form->field($model, 'q4_target') ?>

    <?php // echo $form->field($model, 'strategic_objective') ?>

    <?php // echo $form->field($model, 'department') ?>

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
