<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
use MP\SelectModel\MPModelSelect;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchOfficersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="church-officers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user_id',[ 'options' => ['style' => 'width: 60%']])->widget(MPModelSelect::class, [
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
                'placeholder' => Yii::t('app', 'Search User ...'),
                'multiple'    => false,
            ],
            'pluginOptions' => [
                'minimumInputLength' => 2,
            ],
        ],
    ]) ?>
    <?php // echo $form->field($model, 'id') ?>

    <?php // echo $form->field($model, 'position_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>