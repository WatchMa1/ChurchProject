<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentalExpenseItems */
/* @var $form yii\widgets\ActiveForm */
    $year = Yii::$app->getRequest()->getQueryParam('year');  

?>

<div class="departmental-expense-items-form">

    <?php $form = ActiveForm::begin(); ?>

    <label>Fund Item - <?= $year?></label>
    <?= $form->field($model, 'fund_item',[ 'options' => ['style' => 'width: 100%']])->dropDownList(\yii\helpers\ArrayHelper::map(FundItems::find()->where(['year'=>$year])->asArray()->all(),
                'id', 'item_name'), ['id' => 'item_name'])->label(false) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>