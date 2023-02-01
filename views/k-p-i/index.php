<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
/* @var $this yii\web\View */
/* @var $searchModel app\models\KPISearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kpis';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create KPI</button> to create a new key point indicator.</li></ul>';
?>
<div class="kpi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kpi', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Proceed to fill out score card',['initiative/'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 
        $dataProvider = new ArrayDataProvider([
            'allModels' => $kpis,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'attributes' => ['strategic_objectives'],
            ],
        ]);
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'measure',
            'yearly_target',
            'q1_target',
            'q2_target',
            'q3_target',
            'q4_target',
            [
                'attribute' => 'strategic_objective',
                'value' => 'strategicObjective.objective'
            ],
            //'department',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Actions',
                'buttons'  => [
                'view' => function ($url, $model) {
                    return Html::a('Edit', ['k-p-i/update', 'id' => $model->id],
                    ['title' => 'Edit']);
                    },
                ],
                'template' => '{view} {update} {delete}',
            ],
        ],
    ]); ?>


</div>
