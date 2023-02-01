<?php

use yii\base\Model;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeeklyScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weekly Announcements';
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekly-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p class="">
    <div>
        <?= Html::a('<i class="fas fa-sitemap"></i> Schedule Management', ['/manage-schedule'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fa fa-calendar-plus"></i> Weekly Schedules', ['index'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fas fa-newspaper"></i> Weekly Bulletins', ['bulletins'], ['class' => 'btn btn-success mx-2']) ?>
    </div>
    <div class="text-center">
        <span class="font-weight-bold text-info ">Only scheduled dates can have Announcements</span>
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
                'attribute' => 'announcements',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['announcements']) > 0){
                            $data = $model['announcements'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'cares_concern',
                'value' => function ($model,$key, $index) {
                        if (strlen($model['cares_concern']) > 0){
                            $data = $model['cares_concern'];                   
                            return '<div class="">'.$data.'</div>';
                        } else {
                            return '<em>not added</em>';
                        }
                },
                'format' => 'html',
            ],

            //'cares_concern:ntext',
            //'announcements:ntext',
            //'sabbath_school:ntext',
            //'main_service:ntext',
            //'afternoon_service:ntext',
            //'personal_ministries:ntext',
            //'health_message:ntext',
            //'other:ntext',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['weekly-schedule/view-announcement', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['weekly-schedule/update-announcement', 'id' => $model->id],
                            ['title' => 'Update']);
                    }
                ],
                'template' => '{view} {update} {delete}'],


        ],
    ]); ?>


</div>