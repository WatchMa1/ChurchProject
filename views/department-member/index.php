<?php

use yii\data\ArrayDataProvider;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\Member;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DepartmentMemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Department Members';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Create Department Member</button> to create a new member of your department.</li></ul>';
$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

           [
               'attribute' => 'first_name',
                'value' => function($model) {
                    $member=Member::findOne(['id' => $model->member]);
                    if ($member) {
                        $fn_ = $member->first_name;
                    } else {
                        $fn_ = '';
                    }
                    return $fn_;
        }
    ],
     [
               'attribute' => 'last_name',
                'value' => function($model) {
                    $member=Member::findOne(['id' => $model->member]);
                    if ($member) {
                        $ln_ = $member->last_name;
                    } else {
                        $ln_ = '';
                    }
                    return $ln_;
        }
    ],

    [
               'attribute' => 'gender',
                'value' => function($model) {
                    $member=Member::findOne(['id' => $model->member]);
                    if ($member) {
                        $gn_ = $member->gender;
                    } else {
                        $gn_ = '';
                    }
                    return $gn_;
        }
    ],
    
    'role',
    
    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['department-member/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['department-member/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'delete' => function ($url, $model){ 
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['department-member/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
            }
        ],
        'template' => '{view} {update} {delete}'],
];
?>
<div class="department-member-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Department Member', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>
</div>
