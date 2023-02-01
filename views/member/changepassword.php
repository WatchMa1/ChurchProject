<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */


?>
<hr>
<div class="site-login">
    
<div class="card shadow">
    <div class="card-header" align="center">
        <h3>Change Password</h3>
    </div>
    <div class="card-body" >
    <?php $form = ActiveForm::begin(); ?>
        <div  align="center">
            <label>Current Password<span class="required">*</span></label><br>
            <?= $form->field($model, 'password')->passwordInput()->label('') ?>
            <br>
        
            <label>New Password<span class="required">*</span></label><br>
            <?= $form->field($model, 'new_password')->passwordInput()->label('') ?>
        <br>
        
            <label >Confirm Password<span class="required">*</span></label><br>
            <?= $form->field($model, 'confirm_password')->passwordInput()->label('') ?>
        <br>
            
        
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
        
        
    <?php ActiveForm::end(); ?>
    </div>

</div><!-- site-changepassword -->
</div>
