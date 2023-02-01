<?php
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMember */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card shadow" >
<div class="card-body">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member')->dropDownList($ah, ['prompt' => 'Select a Member....']) ?>

    <?= $form->field($model, 'role')->dropDownList(['Head' => 'Head', 'Assistant Head' => 'Assistant Head', 'Secretary' => 'Secretary', 'Member' => 'Member'],
    ['prompt' => 'Select the role']) ?>

        <?= $form->field($model, 'year')->textInput(['maxlength' => true, 'placeHolder' => 'Year']) ?>
    </div>
    
    <div class="card-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

