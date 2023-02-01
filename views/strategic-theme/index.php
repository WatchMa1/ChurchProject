<?php

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use app\models\StrategicPlan;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StrategicThemeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Strategic Themes';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Strategic Theme</button> to create a new strategic theme.</li></ul>';

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'theme',
           [
               'attribute' => 'strategic_plan',
                'value' => function($model) {
                return StrategicPlan::findOne(['id' => $model->strategic_plan])->name;
        }
    ],

    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['strategic-theme/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['strategic-theme/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['strategic-theme/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>
<div class="strategic-theme-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Strategic Theme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>
