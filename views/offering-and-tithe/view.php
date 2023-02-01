<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\OfferingAndTithe */

$this->title = 'RECEIPT '.$model->receipt_id;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
\yii\web\YiiAsset::register($this);
?>
<div class="offering-and-tithe-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->receipt_id,'year'=>$year], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <div class="mb-4">


        <?php 
        $receipt_columns = [
            //'id',
            [
                'attribute' => 'user',
                'value' => function ($model) {
                    $user = strtoupper($model->user0->fullName);
                    return $user;          
                },
                'label' => 'Member'
            ],
            'receipt_id',
            [
                'attribute' => 'receiptTotal',
                'value' => function ($model) {
                    $receipts = $model->receipts;
                    $total_amount = 0;
                    foreach ($receipts as $index => $receipt) {
                        $amount = $receipt->amount;
                        $total_amount = $total_amount + $amount;
                    } 

                    return 'K '.number_format($total_amount,2);        
      
                }
            ]
        ];
        $other_colums = ['date_of_receipt:date',
            'addedBy.fullName:text:Added By',
            'updatedBy.fullName:text:Updated By',
            'created_at:date',
            'updated_at:date'];
            if (User::userIsAllowedTo('Manage Users')) {
                foreach ($other_colums as $col) {
                    array_push($receipt_columns,$col);
                }
            }
    ?>
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => $receipt_columns,
    ]) ?>

    </div>
    <div class="mb-3 rounded border p-3">
        <H4 class="font-weight-bold text-center">RECEIPT DETAILS: <?= $model->receipt_id?></H4>
        <?php 
        $receipts = $model->receipts;
        $total_amount = 0;
        $attributes = array();
        foreach ($receipts as $index => $receipt) {
            $fund_item = $receipt->fund_item;
            $fund_category = FundItems::findOne($fund_item);
            $category_name = (is_object($fund_category)) ? $fund_category->item_name : '';
            $amount = $receipt->amount;
            $total_amount = $total_amount + $amount;   
            $amount_text = 'K '.number_format($amount,2);        
            $attr = [
                'attribute' => $category_name,
                'value' => $amount_text,
            ];
            array_push($attributes,$attr);

?>


        <?php

        } 

    ?>
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>
    </div>



</div>