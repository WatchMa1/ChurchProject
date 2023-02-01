<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use floor12\summernote\Summernote;
use app\models\User;
use MP\SelectModel\MPModelSelect;
/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weekly-schedule-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'day',[ 'options' => ['style' => 'width: 100%']])->textInput(['type'=>'date']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'theme',[ 'options' => ['style' => 'width: 100%']])->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <?= $form->field($model, 'elder_one',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'elder_two',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'clerk_one',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'clerk_two',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'deacon_one',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'deacon_two',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>