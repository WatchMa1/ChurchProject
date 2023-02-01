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
$longMonthNames = array(
    1 => 'January & February', 
    2 => 'February & March', 
    3 => 'March & April', 
    4 => 'April & May', 
    5 => 'May & June', 
    6 => 'June & July', 
    7 => 'July & August', 
    8 => 'August & September', 
    9 => 'September & October', 
    10 => 'October & November', 
    11 => 'November & December',
    12 => 'December'
);


$year = Yii::$app->getRequest()->getQueryParam('year');
$m1 = (int)Yii::$app->getRequest()->getQueryParam('m');
if ((strlen($m1) < 1) || ($m1 < 1) || ($m1 > 12)) {
    $m1 = date('m');
}
$months = $longMonthNames[$m1];
$m2 = ($m1 != 12) ? $m1+1 : 1;
$m3 = ($m2 != 12) ? $m2+1 : 1;

$year_cal = ($m1 == 12) ? $year+1 : $year;
$year_cal2 = ($m2 == 12) ? $year+1 : $year;
$m1_str = (strlen($m1)==1) ? '0'.$m1 : $m1;
$m2_str = (strlen($m2)==1) ? '0'.$m2 : $m2;
$m3_str = (strlen($m3)==1) ? '0'.$m3 : $m3;
$m1startDate = strtotime($year.'-'.$m1_str.'-01');
$m1stopDate = strtotime($year_cal.'-'.$m2_str.'-01');
$m2stopDate = strtotime($year_cal2.'-'.$m3_str.'-01');
$m1_text = date('F',$m1startDate);
$m2_text = date('F',$m1stopDate);

$this->title = 'Monthly Departmental Expenditures and Balances - '.$months.' '.$year;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$m1_column = [
    'attribute' => 'm1',
    'value' => function($model) use ($year,$m1startDate,$m1stopDate){
        $min = $m1startDate;
        $max = $m1stopDate;
        $fund_item_id = $model->fund_item;
        $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        $amount_text = 'K '.number_format($ytd,2);  
        return $amount_text;
    },
    'label' => $m1_text.' '.$year,
];
if ($m2 != 1) {
    $m2_column = [
        'attribute' => 'm2',
        'value' => function($model) use ($year,$m1stopDate,$m2stopDate){
            $min = $m1stopDate;
            $max = $m2stopDate;
            $fund_item_id = $model->fund_item;
            $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
            $amount_text = 'K '.number_format($ytd,2);  
            return $amount_text;
        },
        'label' => $m2_text.' '.$year_cal,
    ];
} else {
    $m2_column = $m1_column;
}

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
            $m1_column,
            $m2_column,

            [
                'attribute' => 'YTD',
                'value' => function($model) use($year,$m2stopDate) {
                    $minDate = $year.'-01-01';
                    $min = strtotime($minDate);
                    $max = $m2stopDate;
                    $fund_item_id = $model->fund_item;
                    $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
                    $amount_text = 'K '.number_format($ytd,2);  
                    return $amount_text;
                },
                'label' => 'Actual YTD',
            ],
            [
                'attribute' => 'budget',
                'value' => function($model) use($year,$m1){
                    $fund_item_id = $model->fund_item;
                    $fund_model = FundItems::findOne($fund_item_id);
                    $amount = $fund_model->budget;
                    if ($amount != 0) {
                        $quotient = $amount / 12;
                        $m2 = ($m1 != 12) ? $m1+1 : 12;
                        $budgeted_ytd = $quotient * $m2;
                    } else {
                        $budgeted_ytd = $amount;
                    }
                    $amount_text = 'K '.number_format($budgeted_ytd,2);  
                    return $amount_text;
                },
                'label' => 'Budgeted YTD'
            ],
            [
                'attribute' => 'variance',
                'value' => function($model) use($year,$m2stopDate) {
                    $minDate = $year.'-01-01';
                    $min = strtotime($minDate);
                    $max = $m2stopDate;
                    $fund_item_id = $model->fund_item;
                    $fund_model = FundItems::findOne($fund_item_id);
                    $budget = $fund_model->budget;
                    $ytd = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
                    $balance = $budget - $ytd;
                    $sign = ($balance < 0) ? '-' : '';
                    $amount_text = $sign.'K '.number_format(abs($balance),2);  
                    return $amount_text;
                },
                //'label' => 'Variance'
            ],
        ];



?>
<div class="departmental-expenditure-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="my-1">
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
                            echo  '<div>'.Html::a($curYearIteration, ['monthly-departmental-expenditure','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
                            }
                            
                        }
                    ?>
            </div>

        </div>
        <div class="btn-group">

            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Month(s) (<?= $months?>)
            </button>
            <div class="dropdown-menu">
                <?php 

            for ($i=1; $i <= count($longMonthNames); $i++) { 
                $curMonth = $longMonthNames[$i];
                $month_class = ($m1 == $i) ? '' : '-outline';
                if ($curMonth) {
                echo  '<div>'.Html::a($curMonth, ['monthly-departmental-expenditure','year' => $year, 'm'=>$i], ['class' => 'mx-2 my-1 btn btn'.$month_class.'-primary btn-sm']).'</div>' ;
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
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="text-center my-3">

    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>