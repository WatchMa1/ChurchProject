<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use floor12\summernote\Summernote;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weekly-schedule-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'sabbath_school')->widget(Summernote::class); ?>

    <?= $form->field($model, 'main_service')->widget(Summernote::class); ?>

    <?= $form->field($model, 'afternoon_service')->widget(Summernote::class); ?>

    <?= $form->field($model, 'health_message')->widget(Summernote::class); ?>
    
    <?= $form->field($model, 'pastor_coner')->widget(Summernote::class); ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>