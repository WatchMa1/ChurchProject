<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InitiativeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Initiatives';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Initiative</button> to create a new initiative for your department.</li></ul>';
?>
<div class="initiative-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Initiative', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Create Multiple', ['create-multiple'], ['class' => 'btn btn-success']) ?>

    <div class="dropdown dropright mb-3">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Edit Scorecard
        </a>

        <div class="dropdown-menu ">
            <?= Html::a('Strategic Objectives', ['strategic-objective/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('KPIs', ['k-p-i/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('View Scorecard', ['/scorecard/'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>

        </div>
    </div>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); 


    $dataProvider = new ArrayDataProvider([
        'allModels' => $initiatives,
        'pagination' => [
            'pageSize' => 10,
        ],
        'sort' => [
            'attributes' => ['strategic_objectives'],
        ],
    ]);
    ?>
    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'activity',
                'start_date:date',
                'end_date:date',
                'budget',
                //'comments',
                [
                    'attribute' => 'strategic_objectives',
                    'value' => 'strategicObjectives.objective'
                ],
                [
                    'attribute' => 'kpi',
                    'value' => 'kpi0.measure'
                ],
                [
                    'attribute' => 'responsible_person',
                    'value' => 'responsible.fullName'
                ],
                //'department',
                //'created_at',
                //'created_by',
                //'updated_at',
                //'updated_by',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'buttons'  => [
                        'update' => function ($url, $model) {
                            return Html::a(
                                '<span class="fa fa-pencil-alt"></span>',
                                ['initiative/update', 'id' => $model->id],
                                ['title' => 'Edit']
                            );
                        },
                        'delete' => function ($url, $model) {
                            return Html::a(
                                '<span class="fa fa-trash"></span>',
                                ['initiative/delete', 'id' => $model->id],
                                [
                                    'title' => 'Delete',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this Initiative?'),
                                    'data-method' => 'post'
                                ]
                            );
                        },
                        'template' => '{view} {update} {delete}',
                    ],
                ],
            ],
        ]); ?>
    </div>

</div>