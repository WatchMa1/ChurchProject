<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Family */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card-body">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'tag' => false,
                'enctype' => 'multipart/form-data'
            ],
        ],
    ]); ?>
    <div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="form-group field-family-family_name">
            <?= $form->field($model, 'family_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter family name'])->label('Family Name<span class="required">*</span>') ?>
        </div>
        <div class="form-group field-family-family_photo">
            <label class="control-label">Please upload an image<span class="required">*</span></label><br/>
            <?php
            if(!empty($model->family_photo)) {?>
                <br/>
                <?= Html::img('@web/uploads/family_photo/'.$model->family_photo, ['height'=>'200'])?>
                <br/>
            <?php } ?>
            <?= $form->field($model, 'family_photo')->fileInput(['accept' => 'image/jpeg, image/png'])->label(false) ?>
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="form-group field-family-prayer_band">
            <?= $form->field($model, 'prayer_band')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter prayer band'])->label('Prayer Band<span class="required">*</span>') ?>
        </div>
    </div>
    </div>
</div>
<div class="card-footer">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
