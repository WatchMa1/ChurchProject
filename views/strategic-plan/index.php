<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StrategicPlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Strategic Plans';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    'name',
    'description',
    'start_year',
    'finish_year',
    
    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['department-member/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['department-member/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['department-member/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>
<div class="strategic-plan-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Strategic Plan', ['create'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('Strategic Themes', ['/strategic-theme/index'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>
