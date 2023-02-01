<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\User;
use app\models\Department;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FundItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Fund Items';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-items-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Fund Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'item_name',
            [
                'attribute' => 'fund_category',
                'value' => function ($model) {
                    $category = $model->fund_category;
                    switch ($category) {
                        case '20':
                            $category_name = 'LOCAL FUNDS';
                            break;
                        case '21':
                            $category_name = 'LOCAL TRUST FUNDS ';
                            break;
                        case '23':
                            $category_name = 'TRUST FUNDS';
                            break;
                        default:
                            $category_name = 'LOCAL FUNDS';
                            break;
                    }
                    return $category_name;
                
                }
            ],
            'year',
            [
                'attribute' => 'budget',
                'value' => function ($model) {
                    return 'K '.number_format($model->budget,2);

                }
            ],
            [
                'attribute' => 'Department',
                'value' => function ($model) {
                    $dept = $model->dept;
                    if (strlen($dept) > 0 ){
                        if (($depModel = Department::findOne(['id' => $dept])) !== null){
                            $depname = $depModel->name;
                            return $depname;
                        }
                    } 
                    return '--none--';
                    
                
                }
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Actions', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['fund-items/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['fund-items/update', 'id' => $model->id],
                                ['title' => 'Update']);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['fund-items/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },  
                ],
                'template' => '{view} {update} {delete}'],
        
        ],
    ]); ?>


</div>