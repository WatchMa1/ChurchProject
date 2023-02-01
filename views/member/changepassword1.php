<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <p><h4>Create a new password</h4></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'fieldConfig' => [
            'options' => [
                'tag' => false,
            ],
        ],
    ]); ?>
    <div class="form-group field-loginform-email">
        <label>Please re-enter your email.</label><br>
        <?= $form->field($model, 'email')->textInput(['autocorrect' => 'off', 'autocapitalize' => 'none',
            'autocomplete' => 'off', 'autofocus' => false])->label('') ?>
    </div>
    <div class="form-group field-loginform-password">
        <?= $form->field($model, 'new_password')->passwordInput() ?>
    </div>
    <div class="form-group field-loginform-password">
        <?= $form->field($model, 'confirm_password')->passwordInput() ?>
    </div>
        <br/>
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
