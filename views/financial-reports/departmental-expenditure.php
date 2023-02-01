<?php

use app\models\FundItems;
use app\models\IncomesAndExpenses;
use kartik\export\ExportMenu;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
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

$year = Yii::$app->getRequest()->getQueryParam('year');

$this->title = $year.' Departmental Expenditures and Balances';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'fund_item',
                'value' => function ($model) {
                    $year = Yii::$app->getRequest()->getQueryParam('year');
                    $minDate = $year.'-01-01';
                    $maxDate = $year.'-12-31';
                    return  '<div>'.Html::a($model->fundItem['item_name'], ['/incomes-and-expenses/index', 'year' => $year, 'IncomesAndExpensesSearch[fund_item]'=> $model->fund_item, 'date_of_trans_from'=>$minDate, 'date_of_trans_to'=>$maxDate], ['class' => 'font-weight-bold']).'</div>';

                },
                'format' => 'html'

            ],
            [
                'attribute' => 'YTD',
                'value' => function($model) {
                    $year = Yii::$app->getRequest()->getQueryParam('year');      
                    $minDate = $year.'-01-01';
                    $min = strtotime($minDate);
                    $maxDate = $year.'-12-31';
                    $max = strtotime($maxDate);
                    $fund_item_id = $model->fund_item;
                    $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<=$max"])->sum('amount');
                    $amount_text = 'K '.number_format($ytd,2);  
                    return $amount_text;
                },
                'label' => 'YTD'
            ],
            [
                'attribute' => 'budget',
                'value' => function($model) {
                    $fund_item_id = $model->fund_item;
                    $fund_model = FundItems::findOne($fund_item_id);
                    $amount = $fund_model->budget;
                    $amount_text = 'K '.number_format($amount,2);  
                    return $amount_text;
                },
                'label' => 'Annual Budget'
            ],
            [
                'attribute' => 'balance',
                'value' => function($model) {
                    $year = Yii::$app->getRequest()->getQueryParam('year');      
                    $minDate = $year.'-01-01';
                    $min = strtotime($minDate);
                    $maxDate = $year.'-12-31';
                    $max = strtotime($maxDate);
                    $fund_item_id = $model->fund_item;
                    $fund_model = FundItems::findOne($fund_item_id);
                    $budget = $fund_model->budget;

                    $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<=$max"])->sum('amount');
                    
                    $balance = $budget - $ytd;
                    $sign = ($balance < 0) ? '-' : '';
                    $amount_text = $sign.'K '.number_format(abs($balance),2);  
                    return $amount_text;
                },
                //'label' => 'Balance'
            ],
        ];



?>
<div class="departmental-expenditure-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn-group">

        <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">
            Year (<?= $year?>)
        </button>
        <div class="dropdown-menu">
            <?php 
                $fundyearData = FundItems::find()->select('year')->distinct()->all();
                foreach ($fundyearData as $row) {
                    $curYearIteration = $row['year'];
                    if ($curYearIteration) {
                    echo  '<div>'.Html::a($curYearIteration, ['departmental-expenditure','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
                    }
                    
                }
            ?>
        </div>

    </div>

    <?= Html::a('Manage Departmental Exp Items', ['/departmental-expense-items'], ['class' => 'btn btn-success']) ?>
    <?= ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'dropdownOptions' => [
            'label' => 'Export',
            'class' => 'btn btn-success'
        ],
        'filename' => ''.$this->title.' - '.date("d-m-Y"),
        'exportConfig' => [
            ExportMenu::FORMAT_PDF => [
                'pdfConfig' => [
                    'methods' => [
                        'SetHeader' => ['University SDA Church - '.$this->title.''],
                        'SetFooter' => ['{PAGENO}' . ' Copyright - University SDA CMS'],
                        'SetSubject' => [''.$this->title.''],
                        'SetAuthor' => ['Church Management System'],
                    ],
                ],
            ],
        ],
    ]) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="text-center my-3">

    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>