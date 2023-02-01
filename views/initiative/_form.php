<?php

use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use app\models\KPI;
use app\models\StrategicObjective;
use app\models\StrategicTheme;
use app\models\DepartmentMember;
/* @var $this yii\web\View */
/* @var $model app\models\Initiative */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow">

     <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'tag' => false,
                'enctype' => 'multipart/form-data'
            ],
        ],
    ]); ?>
     <div class="card-header">
        <h4>Initiative</h4>
    </div>
    <div class="card-body">
        <div class="row" >
         <div style="width: 20rem;">
    
        
        <?php $dep = DepartmentMember::findOne(['id' => 0]);
             //var_dump($depmembers);
             ?>
        <?= $form->field($model, 'activity')->textInput(['maxlength' => true, 'placeHolder' => 'Activity'])->label(false); ?><br>

        <?php  /* echo $form->field($model, 'responsible_person')->dropDownList(\yii\helpers\ArrayHelper::map(DepartmentMember::find()->asArray()->all(),
                'id', 'name0'), ['prompt' => 'Responsible Person'])->label(false); */
                ?>
         
         <?= $form->field($model, 'budget')->textInput(['maxlength' => true, 'placeHolder' => 'Budget per Activity'])->label(false); ?><br>

         <?= $form->field($model, 'comments')->textInput(['maxlength' => true, 'placeHolder' => 'Comments here....'])->label(false); ?><br>
             
             <?= $form->field($model, 'kpi')->dropDownList(\yii\helpers\ArrayHelper::map(KPI::find()->asArray()->all(),
                'id', 'measure'), ['prompt' => 'KPI'])->label(false) ?><br>
             
             <?= $form->field($model, 'strategic_objective')->dropDownList(\yii\helpers\ArrayHelper::map(StrategicObjective::find()->asArray()->all(),
                'id', 'objective'), ['prompt' => 'Strategic Objective'])->label(false) ?> <br>
				
			 <?= $form->field($model, 'strategic_theme')->dropDownList(\yii\helpers\ArrayHelper::map(StrategicTheme::find()->asArray()->all(),
                'id', 'theme'), ['prompt' => 'Strategic Theme'])->label(false) ?>
            </div>
        <div >
                  <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select start date ...'],
                    'type' => DatePicker::TYPE_INLINE,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false) ?>
            </div>
          
            <div>
                <?= $form->field($model, 'end_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select end date ...'],
                    'type' => DatePicker::TYPE_INLINE,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false) ?>
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
