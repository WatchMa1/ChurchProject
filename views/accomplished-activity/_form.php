<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Initiative;
use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model app\models\AccomplishedActivity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow  justify-content-center" >

    <?php $form = ActiveForm::begin(); ?>
    <div class="my-3 d-flex "  >
    <div class="card-body d-flex flex-column justify-content-center" >
        <div class="row justify-content-center" >
            <div class=" mx-2" >
                <div class="form-group field-user-first_name ">
        
                 <?php 
                 $session = Yii::$app->session;
                    $department_id = $session['department'];
                    
                 echo $form->field($model, 'initiative')->dropDownList(\yii\helpers\ArrayHelper::map(Initiative::find()->where(['department_id' => $department_id])->asArray()->all(),
                        'id', 'activity'), ['prompt' => 'Select Initiative to Report']);?>
              
                   
                    <?= $form->field($model, 'quarter')->dropDownList([1 => 'Quarter 1', 2 => 'Quarter 2', 3 => 'Quarter 3', 4 => 'Quarter 4'], ['prompt'=>'Please select the quarter....']);?>
                </div>
        
                <div class="form-group field-user-first_name">
                    <label></label>
                    <?= $form->field($model, 'achieved_score')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'PlaceHolder' => 'Achieved Score on activity'])->label(false) ?>
                </div> 
                <div class="form-group field-user-first_name">
                    <label></label>
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
                <div class="form-group field-user-first_name " >
                    
                    <?= $form->field($model, 'reason_for_disparity')->textArea(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off']);?> 
               
                </div>
            </div>
        </div>
        <div class="form-group d-flex justify-content-center">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success w-50']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

</div>
