<?php
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InterestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Interests';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
            'first_name',
            'other_name',
            'last_name',
            'gender',
            'email:email',
    
    
    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['interest/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['interest/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['interest/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>
<div class="strategic-objective-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create An Interest', ['create'], ['class' => 'btn btn-success']) ?>    
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>


</div>