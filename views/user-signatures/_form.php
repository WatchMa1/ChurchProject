<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserSignatures */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-signatures-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">
        <label class="control-label">Upload Photo Of your signature</label><br />
        <?php if(!empty($model->signature)) {?>
        <?= Html::img('@web/uploads/user_signature/'.$model->signature, ['height'=>'200'])?>
        <?php } ?>
        <?= $form->field($model, 'signature', ['options'=>  ['class' => 'form-control']])->fileInput(['accept' => 'image/jpeg, image/png'])->label(false) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success px-5']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>