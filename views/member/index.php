<?php

use kartik\export\ExportMenu;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Congregation';
$this->params['breadcrumbs'][] = $this->title;
$famColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'family_name',
    [
		'attribute' => 'head_of_family',
		'value' => 'headOfFamily.fullName',
	],
    'prayer_band',

    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['member/view-family', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['member/delete-family', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];

$memColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    [
        'label' => 'Name',
        'value' => function($model) {
            return $model->getFullName();
        }
    ],
    [
        'label' => 'Age',
        'value' => function($model){
            $birthdate = $model->date_of_birth;
            $currentdate = date("Y/m/d");
            $age = date_diff(date_create($birthdate), date_create($currentdate));
            return $age->format("%y");
        }
    ],

    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['member/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['member/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['member/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>
<div class="card shadow">
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <h4>Families</h4>
        <?= ExportMenu::widget([
            'dataProvider' => $families,
            'columns' => $famColumns,

            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-success'
            ],
            'filename' => 'CMS - Families - '.date("d-m-Y")
        ]) ?>
        <?= GridView::widget([
            'dataProvider' => $families,
            'filterModel' => $famModel,
            'columns' => $famColumns,
        ]); ?>

        <br/>
        <h4>Members</h4>
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $memColumns,

            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-success'
            ],
            'filename' => 'CMS - Members - '.date("d-m-Y")
        ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $memColumns,
    ]); ?>

    <?php Pjax::end(); ?>
    </div>
</div>
