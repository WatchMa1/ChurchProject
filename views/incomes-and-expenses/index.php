<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\IncomesAndExpensesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}
$this->title = 'Incomes And Expenses (Combined)';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['finance-and-reports/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-and-expenses-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('New Income/Expense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
    $rqParams = Yii::$app->request->queryParams;
    $fund_id = (array_key_exists('IncomesAndExpensesSearch',$rqParams)) ? $rqParams['IncomesAndExpensesSearch']['fund_item'] : null; 
    $date_of_trans_from = (array_key_exists('date_of_trans_from',$rqParams)) ? $rqParams['date_of_trans_from'] : null; 
    $date_of_trans_to = (array_key_exists('date_of_trans_to',$rqParams)) ? $rqParams['date_of_trans_to'] : null; 
    $searchFundItem = (FundItems::findOne($fund_id)) ? FundItems::findOne($fund_id)->item_name : ' [All Fund]';
    $search_text = 'Showing '.$searchFundItem.' entries';

        $search_text = $search_text. '<strong>';

        if (validateDate($date_of_trans_from)) {
            $search_text = $search_text. ' FROM <u>'.date('d M, Y',strtotime($date_of_trans_from)).'</u>';
        } 
        if (validateDate($date_of_trans_to)) {
            $search_text = $search_text. ' UPTO <u>'.date('d M, Y',strtotime($date_of_trans_to)).'</u>';
        } else {
            $search_text = $search_text. ' till date';
        }
        $search_text = $search_text. '</strong>';
?>
    <div class="text-center my-3">
        <span class="text-primary font-weight-bold"><?= $search_text;?></span>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fundItem.item_name',
            'trans_type',
            'date_of_trans:date',
            [
                'attribute' => 'amount',
                'value' => function($model) {
                    $amount = $model->amount;
                    $amount_text = 'K '.number_format($amount,2);  
                    return $amount_text;
                }
            ],
             ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',  'headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['incomes-and-expenses/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['incomes-and-expenses/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
               
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['incomes-and-expenses/delete', 'id' => $model->id,]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                    },
                    ],
                'template' => '{view} {update} {delete}'
            ],
        ],
    ]); ?>


</div>