<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\ChurchPositions;
use app\models\User;
use MP\SelectModel\MPModelSelect;
/* @var $this yii\web\View */
/* @var $model app\models\ChurchOfficers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="church-officers-form">
    <p class="text-center text-danger">
        Note that the role/rights of the member will change according to the position you assign
    </p>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
        'yearStart' => 1, 'yearEnd' => -5,]);
    ?>
    <?= $form->field($model, 'position_id')->dropDownList(\yii\helpers\ArrayHelper::map(ChurchPositions::find()->asArray()->all(),
                'id', 'name'), //['onchange' => '$.post( "user/departments?role='.'"+$(this).val(), function(data){ $( "select#models.role ).html( data )})'],
                ['id' => 'position'])?>
    <?php
    //if (!$isupdate) {
        $isupdate = (isset($isupdate)) ? $isupdate : false;
        echo $form->field($model, 'user_id',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
            'searchModel'     => User::class,

            'valueField'      => 'id',
            'titleField'      => "fullName",
            'searchFields'    => [
                // convert to orWhere 'id' => query-string and etc.
                'id', 'email', 'first_name','last_name',
                // add related input (will be added to data request and conver to ->andWhere 'category_id' => request value)
                // 'category_id' => new JsExpression('$("#category-id").val()'),
                // more examples see MPModelSelect::searchFields
            ],
            'dropdownOptions' => [
                'options'       => [
                    'placeholder' => Yii::t('app', 'Select User ...'),
                    'multiple'    => false,
                    'disabled' => $isupdate,
                ],
                'pluginOptions' => [
                    'minimumInputLength' => 2,
                ],
            ],
        ]);
    //} ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>