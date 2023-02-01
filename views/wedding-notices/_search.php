<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeddingNoticesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wedding-notices-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'groom_first_name') ?>

    <?= $form->field($model, 'groom_last_name') ?>

    <?= $form->field($model, 'bride_first_name') ?>

    <?= $form->field($model, 'bride_last_name') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'more_info') ?>

    <?php // echo $form->field($model, 'wedding_date') ?>

    <?php // echo $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'family') ?>

    <?php // echo $form->field($model, 'groom_church') ?>

    <?php // echo $form->field($model, 'bride_church') ?>

    <?php // echo $form->field($model, 'is_bride_baptised') ?>

    <?php // echo $form->field($model, 'is_groom_baptised') ?>

    <?php // echo $form->field($model, 'officiating_minister_name') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
