<?php

use kartik\grid\GridView;
use yii\base\Model;
use yii\helpers\Html;

use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeeklyScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weekly Bulletin Extras';
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekly-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="">
    <div>
        <?= Html::a('<i class="fas fa-sitemap"></i> Schedule Management', ['/manage-schedule'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fa fa-calendar-plus"></i> Weekly Schedules', ['index'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fa fa-bell"></i> Announcements', ['announcements'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-bell"></i>Church Contacts', ['/church-contacts'], ['class' => 'btn btn-primary mx-2']) ?>
    </div>
    <div class="text-center">
        <span class="font-weight-bold text-info ">Only scheduled dates can have Bulletins</span>
    </div>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'day:date:Date',
            'theme:ntext',
            [
                'attribute' => 'sabbath_school',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['sabbath_school']) > 0){
                            $data = $model['sabbath_school'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'main_service',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['main_service']) > 0){
                            $data = $model['main_service'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'afternoon_service',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['afternoon_service']) > 0){
                            $data = $model['afternoon_service'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'health_message',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['health_message']) > 0){
                            $data = $model['health_message'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                },
                'format' => 'html',
            ],



            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['weekly-schedule/view-bulletin', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['weekly-schedule/update-bulletin', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'download' => function ($url, $model) {
                        return Html::a('<span class="fa fa-download btn btn-sm btn-primary"></span>', ['weekly-schedule/download-bulletin', 'id' => $model->id],
                            ['title' => 'Download']);
                    }
                ],
                'template' => '{view} {update} {download}'],


        ],
        'responsive' => true,
    ]); ?>


</div>