<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
?>
<hr>
<div class="site-forgotpassword">


    <h4>Find your account</h4>
    <br>
    <br>
    <?php $form = ActiveForm::begin(); ?>
       
            <label>Enter your email address</label><br>
            <?= $form->field($model, 'email')->label('') ?>
        
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

<br>
</div><!-- site-forgotpassword -->
