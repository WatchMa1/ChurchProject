<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FuneralNoticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Funeral Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funeral-notices-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Funeral Notices', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'first_name',
            'last_name',
            'gender:ntext',
            'date_of_death:date',
            //'date_of_birth:date',
            //'address:ntext',
            [
                'attribute' => 'notified by',
                'value' => function($model) {
                    $datamodel = User::findOne(['id' => $model->notified_by]);
                    if (is_object($datamodel)) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>not processed</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'value' => function ($model,$key) {
                    if (isset($model['status'])){
                        $state = ($model['status'] == 1) ? 'Notice Recieved' : 'pending';
                        return '<span class="font-weight-bold text-primary">'.$state.'</span>';
                    } else {
                        return '<em>unset</em>';
                    }
                    },
                'format' => 'html',
            ],
            //'photo:ntext',
            //'position_in_church:ntext',
            //'family_members_and_contacts:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:140px'],
                'buttons'  => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="fa fa-eye btn btn-sm btn-secondary"></span>', ['funeral-notices/view', 'id' => $model->id],
                            ['title' => 'View']);
                    },
                    'update' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['funeral-notices/update', 'id' => $model->id],
                                ['title' => 'Update']);
                        }
                    },
                    'delete' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['funeral-notices/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },  
                    'mark-seen' => function ($url, $model) {
                        if (User::userIsAllowedTo('Manage Users')) {
                            if ($model->status == 1) {
                                return '';
                            } else{
                                return Html::a('<span class="fa fa-check  btn btn-sm btn-primary"></span>', Url::to(['funeral-notices/mark-seen', 'id' => $model->id]), [
                                    'title' => 'Mark as Seen',
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to mark this entry as Recieved?'),
                                    'data-method' => 'post',
                                ]);
                            }
                        }
                    },
                ],
                'template' => '{view} {update} {delete} {mark-seen}'],['class' => 'yii\grid\ActionColumn'],
        ],
        
    ]); ?>


</div>