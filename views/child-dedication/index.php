<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChildDedicationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Child Dedication';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="child-dedication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Request Child Dedication', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.fullName:text:Added By',
            'child_name:ntext',
            'child_gender:ntext',
            //'meaning_name:ntext',
            'father_name',
            //'mother_name',
            //'father_phone',
            //'mother_phone',
            //'father_email:email',
            //'mother_email:email',
            //'father_religious_affiliation:ntext',
            //'father_adventist_membership:ntext',
            //'mother_religious_affiliation:ntext',
            //'mother_adventist_membership:ntext',
            //'photo:ntext',
            [
                'attribute' => 'state',
                'value' => function ($model,$key, $index) {
                    if (isset($model['status'])){
                        $state = ($model['status'] == 1) ? '<span class="text-success">Approved</span>' : 'pending';                   
                        return '<span class="font-weight-bold">'.$state.'</span>';
                    } else {
                        return '<em>unset</em>';
                    }
                    },
                'format' => 'html',
            ],
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:130px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['child-dedication/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['child-dedication/update', 'id' => $model->id],
                                ['title' => 'Update']);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['child-dedication/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },  
                    'approve' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            if ($model->status == 1) {
                                return '';
                            } else{
                                return Html::a('<span class="fa fa-check  btn btn-sm btn-primary"></span>', Url::to(['child-dedication/approve', 'id' => $model->id]), [
                                    'title' => 'Approved',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to approved this entry?'),
                                    'data-method' => 'post',
                                ]);
                            }
                        }
                    },
                ],
                'template' => '{view} {update} {delete} {approve}'],['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>