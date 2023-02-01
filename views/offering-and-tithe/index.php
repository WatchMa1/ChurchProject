<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\export\ExportMenu;
use app\models\FundItems;
use app\models\OfferingAndTitheReceipts;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OfferingAndTitheSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Offerings And Tithes '.$year;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = $this->title;

$gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name',
                'value' => function ($model) {
                    $user = strtoupper($model->user0->fullName);
                    return $user;          
                },
                'label' => 'Member'
            ],
            'receipt_id',
            [
                'attribute' => 'date_of_receipt',
                'value' => function($model) {
                    return date('d M, Y',$model->date_of_receipt);
                },
            ],
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
            ],

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',  'headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['offering-and-tithe/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['offering-and-tithe/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            $receipt_id = $model->receipt_id;
                            $receipt_fund_item = OfferingAndTitheReceipts::findOne(['receipt_id'=>$receipt_id])->fund_item;
                            $year = FundItems::findOne(['id' => $receipt_fund_item])->year;                        
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['offering-and-tithe/delete', 'id' => $model->receipt_id, 'year' => $year,]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                    },
                    ],
                'template' => '{view} {update} {delete}'
            ],
        ]

?>
<div class="offering-and-tithe-index">

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
                        echo  '<div>'.Html::a($curYearIteration, ['offering-and-tithe/index','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
                        }
                        
                    }
                ?>
            </div>
        </div>
        <?= Html::a('New Receipt', ['create','year'=>$year], ['class' => 'btn btn-success']) ?>
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-success'
            ],
            'filename' => 'Tithe and Offerings - '.date("d-m-Y"),
            'exportConfig' => [
                ExportMenu::FORMAT_PDF => [
                    'pdfConfig' => [
                        'methods' => [
                            'SetHeader' => ['University SDA Church - Tithe and Offerings'],
                            'SetFooter' => ['{PAGENO}' . ' Copyright - University SDA CMS'],
                            'SetSubject' => ['Tithe and Offerings'],
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
    <?php echo $this->render('_search', ['model' => $searchModel, 'year'=>$year]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>