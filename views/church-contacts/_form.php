<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ChurchPositions;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchContacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="church-contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'position_id')->dropDownList(\yii\helpers\ArrayHelper::map(ChurchPositions::find()->asArray()->all(),
                'id', 'name'), //['onchange' => '$.post( "user/departments?role='.'"+$(this).val(), function(data){ $( "select#models.role ).html( data )})'],
                ['id' => 'position'])?>



    <div class="form-group">
        <?= Html::submitButton('Add', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>