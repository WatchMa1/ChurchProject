<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\WeddingNoticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Wedding Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wedding-notices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Wedding Notice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'groom_first_name',
            'groom_last_name',
            'bride_first_name',
            'bride_last_name',
            //'address:ntext',
            //'more_info:ntext',
            'wedding_date:date',
            //'phone_number',
            //'family',
            //'groom_church',
            //'bride_church',
            //'is_bride_baptised',
            //'is_groom_baptised',
            //'officiating_minister_name',
            //'added_by',
            //'status',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'noticeStatus',
                'value' => function ($model) {
                        if (isset($model['status'])){
                            $status = $model['status'];
                            switch ($status) {
                                case '1':
                                    $state = '<span class="text-primary">Recieved</span>';
                                    break;
                                case '2':
                                    $state = '<span class="text-success">Done</span>';
                                    break;
                                case '0':
                                    $state = 'pending';
                                    break;
                                default:
                                    $state = 'pending';
                                    break;
                            }                  
                            return '<span class="font-weight-bold">'.$state.'</span>';
                        } else {
                            return '<em>unset</em>';
                        }
                    },
                'format' => 'html',
            ],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',  'headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                            return Html::a('<span class="fa fa-eye mx-2"></span>', ['wedding-notices/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-pencil-alt mx-2"></span>', ['wedding-notices/update', 'id' => $model->id],
                                ['title' => 'Update']);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-trash mx-2"></span>', Url::to(['wedding-notices/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                    'updatestate' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fas fa-tasks mx-2"></span>', ['wedding-notices/update-state', 'id' => $model->id],
                                ['title' => 'Update status']);
                        }
                    },
                ],
                'template' => '{view} {update} {delete} {updatestate}'],

            
        ],
    ]); ?>


</div>