<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Initiative;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\AccomplishedActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow" align="center">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card" style="width: 24rem;" align="center">
    <div class="card-body" align="center">
    <div class="row" >
    <div >
        <div class="form-group field-user-first_name">
        <label><span class="required">*</span></label>
         <?= $form->field($model, 'initiative')->dropDownList(\yii\helpers\ArrayHelper::map(Initiative::find()->asArray()->all(),
                'id', 'activity'), ['prompt' => 'Select Initiative to Report'])->label(false) ?>
      
            <label><span class="required">*</span></label>
            <?= $form->field($model, 'quarter')->dropDownList([1 => 'Quarter 1', 2 => 'Quarter 2', 3 => 'Quarter 3', 4 => 'Quarter 4'], ['prompt'=>'Please select the quarter....'])->label(false) ?>
        </div>

        <div class="form-group field-user-first_name">
            <label><span class="required">*</span></label>
            <?= $form->field($model, 'achieved_score')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off', 'PlaceHolder' => 'Achieved Score on activity'])->label(false) ?>
        </div> 
        <div class="form-group field-user-first_name">
            <label><span class="required">*</span></label>
            <?= $form->field($model, 'color')->widget(\kartik\color\ColorInput::className(), ['showDefaultPalette'=>false,'options' => ['placeholder' => 'Select A Color Code'], 'pluginOptions' => [
                'showInput' => true,
                'showInitial' => true,
                'showPalette' => true,
                'showPaletteOnly' => true,
                'showSelectionPalette' => true,
                'showAlpha' => false,
                'allowEmpty' => false,
                'preferredFormat' => 'name',
            'palette' => [
                [
                "green", "orange", "red",
                ],
            ],   
        ],
])->label(false); ?>
        </div>
        <div class="form-group field-user-first_name" style="width: 14rem;">
            <label>Reasons for Disparity</label>
            <?= $form->field($model, 'reason_for_disparity')->textArea(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?> 
       
        </div>
    </div>
        </div>
        </div>
    <div class="card-footer">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>

</div>
