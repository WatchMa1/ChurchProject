<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use MP\SelectModel\MPModelSelect;
/* @var $this yii\web\View */
/* @var $model app\models\TitheOfferingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tithe-offering-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>


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

    <?php //eco $form->field($model, 'tithe') ?>

    <?php //eco $form->field($model, 'local_church_offering') ?>

    <?php //eco $form->field($model, 'conference_offering') ?>

    <?php // echo $form->field($model, 'campmeeting_offering') ?>

    <?php // echo $form->field($model, 'other_local_church_offering') ?>

    <?php // echo $form->field($model, 'offer_conference_offering') ?>

    <?php // echo $form->field($model, 'deposited') ?>

    <?php // echo $form->field($model, 'added') ?>

    <?php // echo $form->field($model, 'updated') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['tithe-offering/'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>