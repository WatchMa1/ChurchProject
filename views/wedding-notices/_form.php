<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\WeddingNotices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wedding-notices-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="mb-3 row">
        <?= $form->field($model, 'groom_first_name',['options' => ['styles'=>'width:100%']])->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'groom_last_name',['options' => ['styles'=>'width:100%']])->textInput(['maxlength' => true]) ?>
    </div>
    <div class="mb-3 row">
        <?= $form->field($model, 'bride_first_name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'bride_last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="mb-3 row">
        <?= $form->field($model,'is_bride_baptised',['options'=>['class'=>'mx-2', 'styles'=>'width:100%']])->dropDownList(array('yes'=>'yes','no'=>'no'));?>

        <?= $form->field($model,'is_groom_baptised',['options'=>['class'=>'mx-2', 'styles'=>'width:100%']])->dropDownList(array('yes'=>'yes','no'=>'no'));?>
    </div>

    <?= $form->field($model, 'wedding_date')->textInput(['type'=>'date']) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'phone_number')->textInput() ?>

    <?= $form->field($model, 'family')->textInput() ?>

    <?= $form->field($model, 'groom_church')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bride_church')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'officiating_minister_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'more_info')->textarea(['rows' => 3]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>