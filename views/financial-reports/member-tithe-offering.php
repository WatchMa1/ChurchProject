<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use app\models\FundItems;
use app\models\OfferingAndTitheReceipts;



/* @var $this yii\web\View */
/* @var $searchModel app\models\OfferingAndTitheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offerings And Tithes - Member Reciepts - '.$year;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],


    [
        'attribute' => 'receipt_id',
        'value' => function ($model) {
            $r = $model->receipt_id;     
            $r_id = $model->id;     
            return  '<div>'.Html::a($r, ['offering-and-tithe/view','id' => $r_id], ['class' => 'font-weight-bold']).'</div>' ;

        },
        'headerOptions' => ['style' => 'min-width:250px'],
        'format' => 'html'
    ],
    [
        'attribute' => 'name',
        'value' => function ($model) {
            $user = strtoupper($model->user0->fullName);
            return $user;          
        },
        'label' => 'Members',
        'headerOptions' => ['style' => 'min-width:250px']
    ],
/* 
   [
        'attribute' => 'date_of_receipt',
        'value' => function($model) {
            return date('d M, Y',$model->date_of_receipt);
        },
    ],  */
       
];
$all_fund_items = FundItems::find()->where(['year' => $year])->all();

$trust_fund_attributes = array();
$local_fund_attributes = array();

foreach ($all_fund_items as $index => $fund_item_model) {
    $fund_item = $fund_item_model->id;
    $category_id = (is_object($fund_item_model)) ? $fund_item_model->fund_category : '-';
    $fund_name = (is_object($fund_item_model)) ? $fund_item_model->item_name : '-';
    if ($category_id == 23) {
        # trust funds
        $category_name = 'TRUST FUNDS';
        $attr = [
            'label' => strtolower($fund_name),
            'attribute' => $fund_name,
            'value' => function($model) use ($fund_item){
                $receipts = $model->receipts;
                foreach ($receipts as $index => $receipt) {
                    if ($receipt->fund_item == $fund_item ) {
                        $amount = $receipt->amount; 
                        return 'K '.number_format($amount,2);                  
                    }
                } 
                return '';
            },
            'headerOptions' => ['style' => 'min-width:150px']
        ];
        if (!$attr == 0) {

        $trust_fund_attributes[] = $attr;
        }
    } else {
        # local funds
        $category_name = 'LOCAL FUNDS';
        $attr = [
            'label' => strtolower($fund_name),
            'attribute' => $fund_name,
            'value' => function($model) use ($fund_item){
                $receipts = $model->receipts;
                foreach ($receipts as $index => $receipt) {
                    if ($receipt->fund_item == $fund_item ) {
                        $amount = $receipt->amount; 
                        return 'K '.number_format($amount,2);                  
                    } 
                    
                } 
                return '';

            },
            'headerOptions' => ['style' => 'min-width:150px']
        ];
        if (!$attr == 0) {
            $local_fund_attributes[] = $attr;
        }
        
        
    }
}

foreach ($trust_fund_attributes as $key => $col) {
    $gridColumns[]=$col;
}

$total_trust_fund_column = [
    'attribute' => 'totalTrustFunds',
    'value' => function ($model) {
        return 'K '.number_format($model->trustFundsTotal,2);        
    },
    'label' => 'Σ TRUST FUNDS',
    'headerOptions' => ['style' => 'width:150px']
];
$gridColumns[]=$total_trust_fund_column;

foreach ($local_fund_attributes as $key => $col) {
    $gridColumns[]=$col;
}
$total_local_fund_column = [
    'attribute' => 'totalTrustFunds',
    'value' => function ($model) {
        return 'K '.number_format($model->localFundsTotal,2);        
    },
    'label' => 'Σ LOCAL FUNDS',
    'headerOptions' => ['style' => 'width:150px']
];
$gridColumns[]=$total_local_fund_column;


$total_reciept_column = [
    'attribute' => 'receiptTotal',
    'value' => function ($model){
        return 'K '.number_format($model->receiptsTotal,2); 
            
    },
    'label' => 'RECEIPT TOTAL',
    'headerOptions' => ['style' => 'width:150px']

];
$gridColumns[]=$total_reciept_column;




\yii\web\YiiAsset::register($this);


?>
<div class="tithe-and-offering-per-member">

    <h1><?= Html::encode($this->title) ?></h1>

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
                            echo  '<div>'.Html::a($curYearIteration, ['tithe-and-offering-per-member','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
                        }
                        
                    }
                ?>
            </div>
        </div>
        <?= Html::a('New Receipt', ['/offering-and-tithe/create','year'=>$year], ['class' => 'btn btn-success']) ?>
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
    <?php echo $this->render('_search', ['model' => $searchModel, 'year'=>$year, 'url' => 'tithe-and-offering-per-member']); ?>
    <div class="">

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'resizableColumns'=>true,
    ]); ?>

    </div>



</div>