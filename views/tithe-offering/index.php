<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TitheOfferingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tithe & Offerings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tithe-offering-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('New Entry', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="text-center">
        <small class="text-primary">All Amounts in ZMW</small>
    </div>

    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="table-responsive">

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.fullName:text:Member',
            'tithe',
            'local_church_offering',
            'conference_offering',
            'campmeeting_offering',
            'other_local_church_offering',
            'offer_conference_offering',
            'deposited:date',
            'added:date',
            //'updated',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['tithe-offering/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['tithe-offering/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['tithe-offering/delete', 'id' => $model->id]), [
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

</div>