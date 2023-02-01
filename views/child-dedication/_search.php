<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ChildDedicationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="child-dedication-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'child_name') ?>

    <?= $form->field($model, 'child_gender') ?>

    <?= $form->field($model, 'meaning_name') ?>

    <?php // echo $form->field($model, 'father_name') ?>

    <?php // echo $form->field($model, 'mother_name') ?>

    <?php // echo $form->field($model, 'father_phone') ?>

    <?php // echo $form->field($model, 'mother_phone') ?>

    <?php // echo $form->field($model, 'father_email') ?>

    <?php // echo $form->field($model, 'mother_email') ?>

    <?php // echo $form->field($model, 'father_religious_affiliation') ?>

    <?php // echo $form->field($model, 'father_adventist_membership') ?>

    <?php // echo $form->field($model, 'mother_religious_affiliation') ?>

    <?php // echo $form->field($model, 'mother_adventist_membership') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
