<?php

use yii\base\Model;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeeklyScheduleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weekly Schedules';
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekly-schedule-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-sitemap"></i> Schedule Management', ['/manage-schedule'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fa fa-plus"></i> Add Weekly Schedule', ['create'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('<i class="fa fa-bell"></i> Announcements', ['announcements'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fas fa-newspaper"></i> Weekly Bulletins', ['bulletins'], ['class' => 'btn btn-success mx-2']) ?>
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
                'attribute' => 'elder_one',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['elderOne'])){
                        $fullname = $model['elderOne']->fullName;                   
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['user/view', 'id' => $model->elder_one]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'elder_two',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['elderTwo'])){
                        $fullname = $model['elderTwo']->fullName;
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['user/view', 'id' => $model->elder_two]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                },
                'format' => 'html',
            ],

            //'clerk_one',
            //'clerk_two',
            //'deacon_one',
            //'deacon_two',
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
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['weekly-schedule/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['weekly-schedule/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['weekly-schedule/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                    },
                ],
                'template' => '{view} {update} {delete}'],


        ],
    ]); ?>


</div>