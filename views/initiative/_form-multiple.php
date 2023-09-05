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
    <?php $dep = DepartmentMember::findOne(['id' => 0]);
    //var_dump($depmembers);
    ?>


    <?php
    foreach ($multiModel as $index => $model) {
    ?>
    <div class="card-body" id="item-<?= $index + 1 ?>">
        <div class="d-flex">
            <h4>
                Activity <?= $index + 1 ?>
            </h4>
            <div class="ml-2">

                <span class="btn btn-sm btn-outline-danger " onclick="removeItem('<?= $index + 1 ?>')"> Remove</span>
            </div>

        </div>

        <div class="row mb-3">

            <div style="width: 20rem;">

                <?= $form->field($model, "[$index]activity")->textInput(['maxlength' => true, 'placeHolder' => 'Activity'])->label(false); ?><br>

                <?php  /* echo $form->field($model, 'responsible_person')->dropDownList(\yii\helpers\ArrayHelper::map(DepartmentMember::find()->asArray()->all(),
                'id', 'name0'), ['prompt' => 'Responsible Person'])->label(false); */
                    ?>

                <?= $form->field($model, "[$index]budget")->textInput(['maxlength' => true, 'placeHolder' => 'Budget per Activity'])->label(false); ?><br>


                <?= $form->field($model, "[$index]kpi")->dropDownList(\yii\helpers\ArrayHelper::map(
                        KPI::find()->where(['department' => $mydep])->asArray()->all(),
                        'id',
                        'measure'
                    ), ['prompt' => 'KPI'])->label(false) ?><br>

                <?= $form->field($model, "[$index]comments")->textInput(['maxlength' => true, 'placeHolder' => 'Comments here....'])->label(false); ?><br>



            </div>
            <div>

                <?= $form->field($model, "[$index]strategic_theme")->dropDownList(\yii\helpers\ArrayHelper::map(
                        StrategicTheme::find()->asArray()->all(),
                        'id',
                        'theme'
                    ), ['prompt' => 'Strategic Theme'])->label(false) ?>
                <br>

                <?= $form->field($model, "[$index]strategic_objective")->dropDownList(\yii\helpers\ArrayHelper::map(
                        StrategicObjective::find()->where(['department' => $mydep])->asArray()->all(),
                        'id',
                        'objective'
                    ), ['prompt' => 'Strategic Objective'])->label(false) ?> <br>

                <div>

                    <?= $form->field($model, "[$index]start_date")->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Select start date ...'],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ])->label(false) ?>

                </div> <br>

                <div>
                    <?= $form->field($model, "[$index]end_date")->widget(DatePicker::classname(), [
                            'options' => ['placeholder' => 'Select end date ...'],
                            'type' => DatePicker::TYPE_INPUT,
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd'
                            ]
                        ])->label(false) ?>
                </div> <br>



            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <div class="card-footer">
        <div class="form-group d-flex">


            <?= Html::a('<i class="fas fa-arrow-circle-left"></i> Back', ['create-multiple'], ['class' => 'btn btn-secondary']) ?>
            <?= Html::submitButton('Save', ['class' => 'btn btn-success flex-grow-1']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>