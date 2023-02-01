<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BaptismInterest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="baptism-interest-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user')->textInput(['hidden' => 2]) ?>
        

    <div class="form-group">
        <?= Html::submitButton('Yes', ['class' => 'btn btn-success px-5 font-weight-bold']) ?>
        <span class="text-secondary px-2font-weight-bold"> <small>By clicking 'YES', you will be registerd for the
                upcoming baptism.</small></span>
    </div>

    <?php ActiveForm::end(); ?>

</div>