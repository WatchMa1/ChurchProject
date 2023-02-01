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
        <?= $form->field($model,'status')->dropDownList(array('0'=>'Pending','1'=>'Approved','2'=>'Processed','3'=>'Declined'));?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'processed_amount')->textInput() ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'processed_comment')->textarea(['rows'=>2]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>