<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StrategicPlan */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card shadow">
    <?php //var_dump($model->getErrors())?>

    <?php $form = ActiveForm::begin(); ?>
    <div class="card-body" align="center">
  <div class="row" >
            <div class="form-group field-user-first_name">
                <label><span class="required">*</span></label>
                <?= $form->field($model, 'name')->textInput(['placeHolder' => 'Strategic Plan Name Here....', 'maxlength' => true, 'autocorrect' => 'off',
                    'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>
        <br>
                <label><span class="required">*</span></label>
                <?= $form->field($model, 'description')->textInput(['placeHolder' => 'Brief description of the plan....', 'maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?> 
       
            </div>
      
            <div class="form-group field-user-first_name">
                <label>Start Year<span class="required">*</span></label>
                <?php echo $form->field($model, 'start_year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                'yearStart' => 0,
                'yearEnd' => -20,
                ])->label(false);
                ?>
       <br>
            
            
                <label>Finish Year<span class="required">*</span></label>
                <?php echo $form->field($model, 'finish_year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                'yearStart' => 0,
                'yearEnd' => 20,
                ])->label(false);
                ?>
       
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>

<?php ActiveForm::end(); ?>
</div>
