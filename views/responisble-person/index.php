<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ResponisblePersonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Responsible People';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Responsible Person</button> to select which member of your department is responsible for an initiative.</li></ul>';
?>
<div class="responsible-person-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Responsible Person', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Proceed to fill out score card',['/resource-person/'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
    
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $persons,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['initiatives'],
            ],
        ]);
    ?> 

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
    ]); ?>


</div>
