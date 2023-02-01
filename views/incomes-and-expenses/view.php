<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */
$receipt_fund_item = $model->fund_item;
$year = FundItems::findOne(['id' => $receipt_fund_item])->year;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Incomes And Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $year];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="incomes-and-expenses-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'fundItem.item_name',
            'trans_type',
            [
                'attribute' => 'amount',
                'value' => function($model) {
                    $amount = $model->amount;
                    $amount_text = 'K '.number_format($amount,2);  
                    return $amount_text;
                },
                
            ],
            'date_of_trans:date',
            'addedBy.fullName:text:Added By',
            'created_at:date',
            'updated_at:date',
            'updatedBy.fullName:text:Updated By',
        ],
    ]) ?>

</div>