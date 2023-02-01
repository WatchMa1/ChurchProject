<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StrategicPlan;
/* @var $this yii\web\View */
/* @var $model app\models\StrategicTheme */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card-body">
   
        
         <?= $form->field($model, 'strategic_plan')->dropDownList(\yii\helpers\ArrayHelper::map(StrategicPlan::find()->asArray()->all(),
                'id', 'name'), ['prompt' => 'Select Strategic Plan'])->label(false) ?>

        <?= $form->field($model, 'theme')->textInput(['maxlength' => true, 'placeHolder' => 'Strategic Theme'])->label(false) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
