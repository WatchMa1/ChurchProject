<?php

use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Interest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow">
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
    
 <div  style="width: 15rem;">
    <div class="form-group field-member-title">
     <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'placeHolder' => 'First Name'])->label(false); ?>
     </div>
     
      <div class="form-group field-member-title">
     <?= $form->field($model, 'other_name')->textInput(['maxlength' => true, 'placeHolder' => 'other Name'])->label(false); ?>
     </div>

      <div class="form-group field-member-title">
     <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'placeHolder' => 'Last Name'])->label(false); ?>
     </div>
    
      <div class="form-group field-member-title">
    <?= $form->field($model, 'gender')->dropDownList(['Female' => 'Female', 'Male' => 'Male'],
                    ['prompt' => 'Select your gender'])->label(false) ?>
     </div>
    </div>
     
    

    
        <div class="col-md-5 col-md-offset-2">
      <div class="form-group field-member-title">
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter primary email address'])->label(false) ?>
     </div>
     
      <div class="form-group field-member-title">
     <?= $form->field($model, 'residence')->textInput(['maxlength' => true, 'placeHolder' => 'residence'])->label(false); ?>
     </div>
     
      <div class="form-group field-member-title">
     <?= $form->field($model, 'denomination')->textInput(['maxlength' => true, 'placeHolder' => 'Denomination'])->label(false); ?>
     </div>



    <div class="form-group field-member-title">
     <?= $form->field($model, 'need')->dropDownList(['Prayer' => 'Prayer', 'Bible Study' => 'Bible Study', 'Visitation' => 'Visitation', 'Baptism' => 'Baptism'],
                    ['prompt' => 'Select a Need'])->label(false) ?>
    </div>
    </div>
  

    
    <div >
      <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select date ...'],
                    'type' => DatePicker::TYPE_INLINE,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false) ?>

 
</div>
        </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
