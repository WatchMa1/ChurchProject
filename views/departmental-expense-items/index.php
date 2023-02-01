<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentalExpenseItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departmental Expense Items';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['/financial-reports/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departmental-expense-items-index">

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
                        echo  '<div>'.Html::a($curYearIteration, ['departmental-expense-items/index','year' => $curYearIteration], ['class' => 'mx-2 my-1 btn btn-outline-dark btn-sm']).'</div>' ;
                        }
                        
                    }
                ?>
        </div>
    </div>
    <?= Html::a('Create Departmental Expense Items', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fundItem.item_name',
            'year',
            'created_at:date',
            'updated_at:date',

                         ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',  'headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['departmental-expense-items/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['departmental-expense-items/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
               
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['departmental-expense-items/delete', 'id' => $model->id,]), [
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