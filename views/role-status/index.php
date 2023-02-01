<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Leadership History';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-status-index">

<?php if(Yii::$app->session['department_name'] == 'Clerks'){?>
    <p>
        <?= Html::a('Create Leadership History Record', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

<?php $gridColumns = [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
                'attribute' => 'user',
                'value' => 'user0.fullName',
            ],
            [
                'attribute' => 'role',
                'value' => 'role0.name',
            ],
            [
                'attribute' => 'department',
                'value' => 'department0.name',
            ],
            'year',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
    
    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['role-status/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['role-status/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['role-status/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this record?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]);
    ?>


</div>
