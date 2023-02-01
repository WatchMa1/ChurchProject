<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChildDedication */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-dedication-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'child_name')->textInput(['rows' => 6]) ?>

    <?= $form->field($model,'child_gender')->dropDownList(array('male'=>'male','female'=>'female'));?>

    <?= $form->field($model, 'meaning_name')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'father_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mother_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'father_religious_affiliation')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'father_adventist_membership')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'mother_religious_affiliation')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'mother_adventist_membership')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>