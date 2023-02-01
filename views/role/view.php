<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Role */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card-shadow">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card">
        <div class="card-content">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'name',
            'description',
            //'status',
        ],
    ]) ?>
        </div>
    </div>
         
   <div class="card body">
    <div class="card-content">
        <div class="col-md-12">
    
       <h2>Rights</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'name', 
                'value' => 'name'
            ],
            //'description',
            //'status',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',

           ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['right-status/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model) {
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['right-status/delete', 'id' => $model->id, 'role' => $model->id]), [
                        'title' => 'Remove right',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to remove this right?'),
                        'data-method' => 'post',
                    ]);
            },
        ],
        'template' => ' {update} {delete}'],
        ]
    ]); ?>
       <?= Html::a('Add a right to this role', ['right-status/create'], ['class' => 'btn btn-success']) ?>
        </div>
        </div>

</div>
