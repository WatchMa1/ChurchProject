<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FundItems;
use app\models\User;
use MP\SelectModel\MPModelSelect;


/* @var $this yii\web\View */
/* @var $model app\models\OfferingAndTithe */
/* @var $form yii\widgets\ActiveForm */

$min = $year.'-01-01';
$max = $year.'-12-31';
?>

<div class="offering-and-tithe-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'user',[ 'options' => ['style' => 'width: 100%']])->widget(MPModelSelect::class, [
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
    <?= $form->field($model, 'receipt_id')->textInput() ?>
    <?= $form->field($model, 'date_of_receipt')->textInput(['type'=>'date', 'min'=>$min, 'max'=>$max, 'required'=>'']) ?>

    <?php
    $fund_items = FundItems::find()->where(['year' => $year])->asArray()->all();
    $num_of_fund_items = count($fund_items);
    if ($num_of_fund_items == 0) {
        echo '<div class="p-3 border rounded">
        <span class="font-weight-bold">There are no fund items found for the year '.$year.' <br> Please start by adding Fund Items for '.$year.'. </span> '.Html::a('Add Fund Item', ['fund-items/create'], ['class' => 'btn btn-success']).'
        </div>';
    } else {
        echo '<div><span class="fotn-wieight-bold h4">Amounts Recieved</span></div>';
        echo '<div class="border mx-1 py-3 px-2 rounded">';
        $receipts = $model->receipts;
        for ($i=0; $i < $num_of_fund_items; $i++) { 
            $curRow = $fund_items[$i];
            $item_id = $curRow['id'];
            $item_name = $curRow['item_name'];
            $value = '';
            foreach ($receipts as $index => $receipt) {
                if ($receipt->fund_item == $item_id ) {
                    $value = $receipt->amount;
                    //echo 'is same <br>';
                } else {
                    //echo 'not same <br>';
                }
            }
    ?>
    <div class="mb-2">
        <label> <?= $item_name;?></label>
        <input required name="receipts[fund-<?= $item_id;?>]" value="<?=$value?>" type="number" step=".01"
            class="form-control">
    </div>

    <?php
        }        
        echo '</div>';
    
    }
    



    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>