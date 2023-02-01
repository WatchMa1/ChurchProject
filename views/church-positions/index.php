<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChurchPositionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Church Positions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-positions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Church Positions', ['create'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('Church Officers', ['/church-officers'], ['class' => 'btn btn-success mx-2']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description:ntext',
            [
                'attribute' => 'role_id',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['role'])){
                        $fullname = $model['role']->name;                   
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['role/view', 'id' => $model->department_id]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'department_id',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['department'])){
                        $fullname = $model['department']->name;                   
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['department/view', 'id' => $model->department_id]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            //'added_by',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['church-positions/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['church-positions/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['church-positions/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                    },
                ],
                'template' => '{view} {update} {delete}'],['class' => 'yii\grid\ActionColumn'],

        ],
    ]); ?>


</div>