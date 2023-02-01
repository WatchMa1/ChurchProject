<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaymentRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payment Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Payment Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'requested_by',
                'label'=>'Reqsuested By',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['requestedBy'])){
                        $fullname = $model['requestedBy']->fullName;
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['user/view', 'id' => $model->requested_by]));
                        } else {
                            return '<span class="font-weight-bold">'.$fullname.'</span>';
                        }
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'department',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['department0'])){
                        $fullname = $model['department0']->name;  
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['department/view', 'id' => $model->department]));
                        } else {
                            return '<span class="font-weight-bold">'.$fullname.'</span>';
                        }      
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            'amount',
            'strategic_area:ntext',
            'date_required:date',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    $data = $model->status;
                    $data2 = ($model->processed_at) ? date('j-M-Y', $model['processed_at']) : '?-?-?';
                    switch ($data) {
                        case '3':
                            $dataname = '<span class="text-danger"><b>Rejected ('.$data2.')</b></span>';
                            break;
                        case '2':
                            $dataname = '<span class="text-success"><b>Processed ('.$data2.')</b></span>';
                            break;
                        case '1':
                            $dataname = '<span class="text-warning"><b>Approved, not yet Proccessed</b></span>';
                            break;
                        case '0':
                            $dataname = '<span class="text-secondary"><b>Awaiting approval</b></span>';
                            break;
                        default:
                            $dataname = '<span class="text-"><b>Awaiting approval</b></span>';
                            break;
                    }
                    if ($dataname) {
                        return '<em>'.$dataname.'</em>';
                    } else {
                        return '<em>not found</em>';
                    }
                },
                'format' => 'html',

            ],
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',  'headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                            return Html::a('<span class="fa fa-eye mx-2"></span>', ['payment-request/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-pencil-alt mx-2"></span>', ['payment-request/update', 'id' => $model->id],
                                ['title' => 'Update']);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-trash mx-2"></span>', Url::to(['payment-request/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                    'updatestate' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fas fa-tasks mx-2"></span>', ['payment-request/update-state', 'id' => $model->id],
                                ['title' => 'Update status']);
                        }
                    },
                ],
                'template' => '{view} {update} {delete} {updatestate}'],
        
        ],
    ]); ?>


</div>