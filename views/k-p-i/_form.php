<?php

use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use app\models\StrategicObjective;
/* @var $this yii\web\View */
/* @var $model app\models\KPI */
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
    <div class="card-body">
        <div class="row">
            <div class="col-md-5 col-md-offset-2" style="width: 20rem;">
                <div class="form-group mb-3">
                    <?= $form->field($model, 'strategic_objective')->dropDownList(\yii\helpers\ArrayHelper::map(
                        StrategicObjective::find()->asArray()->all(),
                        'id',
                        'objective'
                    ), ['prompt' => 'Strategic Objective']) ?>
                </div>

                <div class="form-group mb-3">
                    <?= $form->field($model, 'measure')->textInput(['maxlength' => true, 'placeHolder' => 'Measure']); ?>
                </div>

                <div class="form-group mb-3">
                    <?= $form->field($model, 'yearly_target')->textInput(['maxlength' => true, 'placeHolder' => 'Yearly Target']); ?>
                </div>

                <div class="form-group mb-3">
                    <?= $form->field($model, 'q1_target')->textInput(['maxlength' => true, 'placeHolder' => 'First Quarter Target']); ?>
                </div>
            </div>

            <div class="col-md-5 col-md-offset-2" style="width: 20rem;">
                <div class="form-group mb-3">
                    <?= $form->field($model, 'q2_target')->textInput(['maxlength' => true, 'placeHolder' => 'Second Quarter Target']); ?>
                </div>

                <div class="form-group mb-3">
                    <?= $form->field($model, 'q3_target')->textInput(['maxlength' => true, 'placeHolder' => 'Third Quarter Target']); ?>
                </div>

                <div class="form-group mb-3">
                    <?= $form->field($model, 'q4_target')->textInput(['maxlength' => true, 'placeHolder' => 'Fourth Quarter Target']) ?>
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