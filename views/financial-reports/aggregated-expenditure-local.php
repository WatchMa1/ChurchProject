<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use app\models\FundItems;
use app\models\IncomesAndExpenses;
use app\models\OfferingAndTithe;
use app\models\OfferingAndTitheReceipts;
use app\models\TitheOffering;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OfferingAndTitheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$longMonthNames = array(
    1 => 'January to February', 
    2 => 'February to March', 
    3 => 'March to April', 
    4 => 'April to May', 
    5 => 'May to June', 
    6 => 'June to July', 
    7 => 'July to August', 
    8 => 'August to September', 
    9 => 'September to October', 
    10 => 'October to November', 
    11 => 'November to December',
    12 => 'December'
);



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


$this->title = 'Local Funds - Aggregated Expenditure Summary - '.$months.' '.$year;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$m1_column = [
    'attribute' => 'm1',
    'value' => function($model) use ($year,$m1startDate,$m1stopDate){
        $minDate = $year.'-01-01';
        $min = strtotime($minDate);
        $max = $m1stopDate;
        $fund_item_id = $model->id;
        $all_fund_givings = OfferingAndTithe::find()->where(['and',"date_of_receipt>=$min","date_of_receipt<$max"])->asArray()->all();
        $all_fund_Receipts_total = 0;
        if($all_fund_givings){
            foreach ($all_fund_givings as $key => $giving) {
                $receipt_id = $giving['receipt_id'];
                $all_fund_Receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $receipt_id])->andWhere(['fund_item' => $fund_item_id])->sum('amount');
                $all_fund_Receipts_total = $all_fund_Receipts + $all_fund_Receipts_total;
            }
        } 
        
        $fund_incomes = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'income'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        $fund_expenses = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        
        $all_fund_Receipts_total = $all_fund_Receipts_total - $fund_expenses + $fund_incomes;
        $sign = ($all_fund_Receipts_total < 0) ? '-' : '';
        $amount_text = $sign.'K '.number_format(abs($all_fund_Receipts_total),2); 
        $amount_text = 'K '.number_format($all_fund_Receipts_total,2); 
        return $amount_text;
    },
    'label' => 'Bal C/F ('.date('d-M-Y',$m1startDate).')',
];
$m1_column_income = [
    'attribute' => 'm1',
    'value' => function($model) use ($year,$m1stopDate,$m2stopDate){
        $min = $m1stopDate;
        $max = $m2stopDate;
        $fund_item_id = $model->id;
        $all_fund_givings = OfferingAndTithe::find()->where(['and',"date_of_receipt>=$min","date_of_receipt<$max"])->asArray()->all();
        $all_fund_Receipts_total = 0;
        if($all_fund_givings){
            foreach ($all_fund_givings as $key => $giving) {
                $receipt_id = $giving['receipt_id'];
                $all_fund_Receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $receipt_id])->andWhere(['fund_item' => $fund_item_id])->sum('amount');
                $all_fund_Receipts_total = $all_fund_Receipts + $all_fund_Receipts_total;
            }
        } 
        
        $fund_incomes = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'income'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        //$fund_expenses = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        
        $all_fund_Receipts_total = $all_fund_Receipts_total + $fund_incomes;
        $sign = ($all_fund_Receipts_total < 0) ? '-' : '';
        $amount_text = $sign.'K '.number_format(abs($all_fund_Receipts_total),2); 
        $amount_text = 'K '.number_format($all_fund_Receipts_total,2); 
        return $amount_text;
    },
    'label' => 'Income',
];
$m1_column_expenses = [
    'attribute' => 'm1',
    'value' => function($model) use ($year,$m1stopDate,$m2stopDate){
        $min = $m1stopDate;
        $max = $m2stopDate;
        $fund_item_id = $model->id;
        $fund_expenses = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
        $amount_text = 'K '.number_format($fund_expenses,2); 
        return $amount_text;
    },
    'label' => 'Expenses',
];
if ($m2 != 1) {
    $m2_column = [
        'attribute' => 'm2',
        'value' => function($model) use ($year,$m1stopDate,$m2stopDate){
            $minDate = $year.'-01-01';
            $min = strtotime($minDate);
            $max = $m2stopDate;
            $fund_item_id = $model->id;
            $all_fund_givings = OfferingAndTithe::find()->where(['and',"date_of_receipt>=$min","date_of_receipt<$max"])->asArray()->all();
            $all_fund_Receipts_total = 0;
            if($all_fund_givings){
                foreach ($all_fund_givings as $key => $giving) {
                    $receipt_id = $giving['receipt_id'];
                    $all_fund_Receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $receipt_id])->andWhere(['fund_item' => $fund_item_id])->sum('amount');
                    $all_fund_Receipts_total = $all_fund_Receipts + $all_fund_Receipts_total;
                }
            } 
            $fund_incomes = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'income'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
            $fund_expenses = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
            
            $all_fund_Receipts_total = $all_fund_Receipts_total - $fund_expenses;
            $sign = ($all_fund_Receipts_total < 0) ? '-' : '';
            $amount_text = $sign.'K '.number_format(abs($all_fund_Receipts_total),2);  
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
        'value' => function ($model) use($year) {

            $minDate = $year.'-01-01';
            $maxDate = $year.'-12-31';
            return  '<div>'.Html::a($model->item_name, ['/incomes-and-expenses/index', 'year' => $year, 'IncomesAndExpensesSearch[fund_item]'=> $model->id, 'date_of_trans_from'=>$minDate, 'date_of_trans_to'=>$maxDate], ['class' => 'font-weight-bold']).'</div>';

        },
        'format' => 'html'

    ],
    $m1_column,
    $m1_column_income,
    $m1_column_expenses,
    [
        'attribute' => 'YTD',
        'value' => function($model) use($year,$m2stopDate) {
            $minDate = $year.'-01-01';
            $min = strtotime($minDate);
            $max = $m2stopDate;
            $fund_item_id = $model->id;
            $all_fund_givings = OfferingAndTithe::find()->where(['and',"date_of_receipt>=$min","date_of_receipt<$max"])->asArray()->all();
            $all_fund_Receipts_total = 0;
            if($all_fund_givings){
                foreach ($all_fund_givings as $key => $giving) {
                    $receipt_id = $giving['receipt_id'];
                    $all_fund_Receipts = OfferingAndTitheReceipts::find()->where(['receipt_id' => $receipt_id])->andWhere(['fund_item' => $fund_item_id])->sum('amount');
                    $all_fund_Receipts_total = $all_fund_Receipts + $all_fund_Receipts_total;
                }
            } 
            
            $fund_incomes = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'income'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
            $fund_expenses = IncomesAndExpenses::find()->where(['fund_item' => $fund_item_id])->andWhere(['trans_type' => 'expense'])->andWhere(['and',"date_of_trans>=$min","date_of_trans<$max"])->sum('amount');
            $all_fund_Receipts_total = $all_fund_Receipts_total - $fund_expenses + $fund_incomes;
            $sign = ($all_fund_Receipts_total < 0) ? '-' : '';
            $amount_text = $sign.'K '.number_format(abs($all_fund_Receipts_total),2);  
            return $amount_text;
        },
        'label' => 'Bal C/F ('.date('d-M-Y',$m2stopDate).')',

    ],

];



?>


<div class="local-funds-expenditure-summary">

    <h4><?= Html::encode($this->title) ?></h4>

    <div class="card-header">
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
                            echo  '<div>'.Html::a($curYearIteration, ['local-funds-expenditure-summary','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
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
                echo  '<div>'.Html::a($curMonth, ['local-funds-expenditure-summary','year' => $year, 'm'=>$i], ['class' => 'mx-2 my-1 btn btn'.$month_class.'-primary btn-sm']).'</div>' ;
                }
                
            }
            ?>
            </div>

        </div>
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
    <div class="text-center">
        <small class="text-primary">All Amounts in ZMW</small>
    </div>
    <?php //echo $this->render('_search2', ['model' => $searchModel, 'year'=>$year, 'url' => 'local-funds-expenditure-summary']); ?>
    <div class="">

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'resizableColumns'=>true,
    ]); ?>

    </div>



</div>