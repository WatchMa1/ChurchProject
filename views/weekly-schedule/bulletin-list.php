<?php

use yii\base\Model;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeeklyScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weekly Bulletins';
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekly-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>


    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'day:date:Date',
            'theme:ntext',

 


            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'download' => function ($url, $model) {
                        return Html::a('<span class="fa fa-download btn btn-sm btn-primary"></span>', ['weekly-schedule/download-bulletin', 'id' => $model->id],
                            ['title' => 'Download']);
                    }
                ],
                'template' => '{download}'],


        ],
    ]); ?>


</div>