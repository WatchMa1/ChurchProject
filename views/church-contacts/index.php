<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChurchContactsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Church Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-contacts-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Church Contacts', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            'created_at:date',
            'updated_at:date',
            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action','headerOptions' => ['style' => 'width:120px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye"></span>', ['church-contacts/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        return Html::a('<span class="fa fa-pencil-alt"></span>', ['church-contacts/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    },
                    'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['church-contacts/delete', 'id' => $model->id]), [
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