<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */
/* @var $form yii\widgets\ActiveForm */

if (User::userIsAllowedTo('Manage Users')) {
    $fund_items_arr = FundItems::find()->where(['year' => $year])->asArray()->all();
} else {
    $dept = Yii::$app->session['department'];
    $fund_items_arr = FundItems::find()->where(['year' => $year,'dept'=>$dept])->asArray()->all();
}


?>

<div class="incomes-and-expenses-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">

        <?= $form->field($model, 'fund_item',[ 'options' => ['style' => 'width: 100%']])->dropDownList(\yii\helpers\ArrayHelper::map($fund_items_arr,
                'id', 'item_name'), ['id' => 'item_name']) ?>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model,'trans_type',[ 'options' => ['style' => 'width: 100%']] )->dropDownList(array('income'=>'Income','expense'=>'Expense'))->label('Type of Transaction');?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'amount',[ 'options' => ['style' => 'width: 100%']])->textInput(['maxlength' => true,'type'=>'number','step'=>'.01']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'date_of_trans',[ 'options' => ['style' => 'width: 100%']])->textInput(['type'=>'date','max'=>date('Y-m-d')]) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>