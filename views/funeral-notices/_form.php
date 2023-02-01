<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FuneralNotices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funeral-notices-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'gender')->dropDownList(array('male'=>'male','female'=>'female'));?>
    <div>
        <?= $form->field($model, 'date_of_birth')->textInput(['type'=> 'date']) ?>

        <?= $form->field($model, 'date_of_death')->textInput(['type'=> 'date']) ?>
    </div>
    <div class="mb-2">
        <label class="control-label">Upload Photo</label><br />
        <?php if(!empty($model->photo)) {?>
        <?= Html::img('@web/uploads/funeral_photo/'.$model->photo, ['height'=>'200'])?>
        <?php } ?>
        <?= $form->field($model, 'photo', ['options'=>  ['class' => 'form-control']])->fileInput(['accept' => 'image/jpeg, image/png'])->label(false) ?>
    </div>
    <div class="mb-3">
        <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>

    </div>


    <?= $form->field($model, 'position_in_church')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'family_members_and_contacts')->textarea(['rows' => 3]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>