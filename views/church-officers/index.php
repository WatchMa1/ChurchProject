<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChurchOfficersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Church Officers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-officers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Church Officer', ['create'], ['class' => 'btn btn-success mx-2']) ?>
        <?= Html::a('Add New Position', ['church-positions/create'], ['class' => 'btn btn-success mx-2']) ?>
    </p>

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute' => 'positionname',
                'label'=>'Position',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['position'])){
                        $fullname = $model['position']->name;                   
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['church-positions/view', 'id' => $model->position_id]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            [
                'attribute' => 'member',
                'value' => function ($model,$key, $index) {
                    if (is_object($model['user'])){
                        $fullname = $model['user']->fullname;                   
                        return Html::a('<span class="font-weight-bold">'.$fullname.'</span>',Url::to(['user/view', 'id' => $model->user_id]));
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            'year',
            //'addedBy.fullName:text:Last updated By',
            //'created_at',
            //'updated_at',

              ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['church-officers/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['church-officers/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['church-officers/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                    },
                    ],
                    'template' => '{view} {update} {delete}'],
        ],
    ]); ?>


</div>