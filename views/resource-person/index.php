<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResourcePersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Resource People';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Resource Person</button> to select a church member as a resource person for an initiative.</li></ul>';
?>
<div class="resource-person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Resource Person', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('View Scorecard',['/scorecard/'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'member',
                'value' => function($model) { 
              return $model->member0->first_name  . " " . $model->member0->other_name ." " . $model->member0->last_name ;
            },
            ],
            [
                'attribute' => 'initiative',
                'value' => 'initiative0.activity'
            ],
            //'created_at',
            //'created_by',
            //'updated_at',
            //'updated_by',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'buttons'  => [
                'view' => function ($url, $model) {
                    return Html::a('Edit', ['resource-person/update', 'id' => $model->id],
                    ['title' => 'Edit']);
                    },
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]);// var_dump($dataProvider);?>
    <?php Pjax::end(); ?>


</div>
