<?php

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
use app\models\strategicTheme;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\StrategicObjectiveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Strategic Objectives';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Strategic Objective</button> to create a new strategic objective.</li></ul>';
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'objective',

    [
        'attribute' => 'strategic_theme',
        'value' => 'strategicTheme.theme',
    ],



    [
        'class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a(
                    '<span class="fa fa-eye"></span>',
                    ['strategic-objective/view', 'id' => $model->id],
                    ['title' => 'View']
                );
            },
            'update' => function ($url, $model) {
                return Html::a(
                    '<span class="fa fa-pencil-alt"></span>',
                    ['strategic-objective/update', 'id' => $model->id],
                    ['title' => 'Update']
                );
            },
            'delete' => function ($url, $model) {
                return Html::a('<span class="fa fa-trash"></span>', Url::to(['strategic-objective/delete', 'id' => $model->id]), [
                    'title' => 'Delete',
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                    'data-method' => 'post',
                ]);
            }
        ],
        'template' => '{view} {update} {delete}'
    ],
];
?>
<div class="strategic-objective-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Strategic Objective', ['create'], ['class' => 'btn btn-success']) ?>

        <?= Html::a('Proceed to fill out score card', ['/k-p-i/'], ['class' => 'btn btn-success']) ?>
    <div class="dropdown dropright mb-3">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Edit Scorecard
        </a>

        <div class="dropdown-menu ">
            <?= Html::a('View Scorecard', ['/scorecard/'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('KPIs', ['k-p-i/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('Initiatives', ['initiative/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>

        </div>
    </div>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>