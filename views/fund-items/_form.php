<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;

/* @var $this yii\web\View */
/* @var $model app\models\FundItems */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fund-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name',['options' => ['style' => ['width'=>'100%']]])->textInput(['maxlength' => true,'class'=>'mb-3 form-control']) ?>

    <?= $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
        'yearStart' => 1, 'yearEnd' => -5,]);
    ?>

    <?= $form->field($model,'fund_category')->dropDownList(array('20'=>'LOCAL FUNDS (e.g. LCB)','21'=>'LOCAL TRUST FUNDS (i.e. not part of LCB)','23'=>'TRUST FUNDS (e.g Tithe)'));?>
    <?= $form->field($model, 'dept')->dropDownList(\yii\helpers\ArrayHelper::map(Department::find()->asArray()->all(),
                'id', 'name'))?>
    <div>
        <?= $form->field($model, 'budget')->textInput(['maxlength' => true,'step'=>'.01'])->label('Budgeted Amount') ?>
        <small class="text-primary">Budget amount in Zambian Kwacha</small>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>