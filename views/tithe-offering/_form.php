<?php

use app\controllers\UserController;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use MP\SelectModel\MPModelSelect;

/* @var $this yii\web\View */
/* @var $model app\models\TitheOffering */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tithe-offering-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user_id',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
            ],
            'pluginOptions' => [
                'minimumInputLength' => 2,
            ],
        ],
    ]) ?>

    <?= $form->field($model, 'tithe')->textInput() ?>

    <?= $form->field($model, 'local_church_offering')->textInput() ?>

    <?= $form->field($model, 'conference_offering')->textInput() ?>

    <?= $form->field($model, 'campmeeting_offering')->textInput() ?>

    <?= $form->field($model, 'other_local_church_offering')->textInput() ?>

    <?= $form->field($model, 'offer_conference_offering')->textInput() ?>

    <?= $form->field($model, 'deposited')->textInput(['value' => date('Y-m-d', time()),'type'=> 'date']) ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>