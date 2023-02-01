<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RightStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="right-status-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'role')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Role::find()->asArray()->all(),
                'id', 'name'), ['prompt' => 'Select a role...'])->label(false) ?>

    <?= $form->field($model, 'right')->dropDownList(\yii\helpers\ArrayHelper::map(app\models\Right::find()->asArray()->all(),
                'id', 'name'), ['prompt' => 'Select a right....'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
