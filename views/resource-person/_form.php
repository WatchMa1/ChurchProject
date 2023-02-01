<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Member;
use app\models\Initiative;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="resource-person-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="card shadow">
        <div class="card-header">
            <h4>Responsible Person</h4>
        </div>
        <div class="card-body">
            <?= $form->field($model, 'initiative')->dropDownList(\yii\helpers\ArrayHelper::map(Initiative::find()->asArray()->all(),
                'id', 'activity'), ['prompt' => 'Initiative'])->label(false) ?>
            <?= $form->field($model, 'member')->dropDownList(\yii\helpers\ArrayHelper::map(Member::find()->asArray()->all(),'id', 'first_name', 'last_name'),
                 ['prompt' => 'Resource Person'])->label(false); ?>

            </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
