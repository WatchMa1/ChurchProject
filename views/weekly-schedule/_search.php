<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklyScheduleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weekly-schedule-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'day') ?>

    <?= $form->field($model, 'theme') ?>

    <?= $form->field($model, 'elder_one') ?>

    <?= $form->field($model, 'elder_two') ?>

    <?php // echo $form->field($model, 'clerk_one') ?>

    <?php // echo $form->field($model, 'clerk_two') ?>

    <?php // echo $form->field($model, 'deacon_one') ?>

    <?php // echo $form->field($model, 'deacon_two') ?>

    <?php // echo $form->field($model, 'cares_concern') ?>

    <?php // echo $form->field($model, 'announcements') ?>

    <?php // echo $form->field($model, 'sabbath_school') ?>

    <?php // echo $form->field($model, 'main_service') ?>

    <?php // echo $form->field($model, 'afternoon_service') ?>

    <?php // echo $form->field($model, 'personal_ministries') ?>

    <?php // echo $form->field($model, 'health_message') ?>

    <?php // echo $form->field($model, 'other') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
