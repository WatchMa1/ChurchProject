<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\StrategicTheme;

/* @var $this yii\web\View */
/* @var $model app\models\StrategicObjective */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card shadow">
   

    <?php $form = ActiveForm::begin([
        //'type' => ActiveForm::TYPE_HORIZONTAL,
    ]); ?>
     <div class="card-body">
         <?= $form->field($model, 'strategic_theme')->dropDownList(\yii\helpers\ArrayHelper::map(StrategicTheme::find()->asArray()->all(),
                'id', 'theme'), ['prompt' => 'Strategic Theme'])->label(false) ?>
        <?= $form->field($model, 'objective'
                    )->textInput(['placeHolder' => "Strategic Objective"])->label(false); ?>            
    </div>
</div>    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

