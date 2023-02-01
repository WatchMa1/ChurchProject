<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Role;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchPositions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="church-positions-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'name',[ 'options' => ['style' => 'width: 100%']])->textInput(['maxlength' => true, 'class'=> 'form-control']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <label>Role<span class="required">*</span></label>
    <?= $form->field($model, 'role_id',[ 'options' => ['style' => 'width: 100%']])->dropDownList(\yii\helpers\ArrayHelper::map(Role::find()->asArray()->all(),
                'id', 'name'), //['onchange' => '$.post( "user/departments?role='.'"+$(this).val(), function(data){ $( "select#models.role ).html( data )})'],
                ['id' => 'role'])->label(false) ?>
    <?= $form->field($model, 'department_id')->widget(DepDrop::classname(), [
		'type' => DepDrop::TYPE_SELECT2,
        'select2Options' => ['pluginOptions' => ['allowClear' => true]],
        'pluginOptions' => [
            'depends' => ['role'],
            'initialize' => $model->isNewRecord ? false : true,
            'url' => Url::to(['/user/departments']),
            //'params' => ['input-type-1', 'input-type-2']
        ]
    ]) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>