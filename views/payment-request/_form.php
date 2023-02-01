<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\User;
use MP\SelectModel\MPModelSelect;
/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payment-request-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row mb-2">
        <?php if (User::userIsAllowedTo('Manage Users')) { ?>
        <?= $form->field($model, 'department',['options'=>['style'=>'width:100%']])->dropDownList(\yii\helpers\ArrayHelper::map(Department::find()->asArray()->all(),
                'id', 'name'), //['onchange' => '$.post( "user/departments?role='.'"+$(this).val(), function(data){ $( "select#models.role ).html( data )})'],
                ['id' => 'position'])?>
        <?php }?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'date_required')->textInput(['type'=> 'date']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'strategic_area')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'purpose')->textarea(['rows'=>2]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'payment_to_be_made_to')->textInput(['maxlength' => true, 'placeholder'=>'Name of person']) ?>
        </div>

    </div>





    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>