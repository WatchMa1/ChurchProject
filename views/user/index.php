<?php

use app\models\Role;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Users';
$this->params['breadcrumbs'][] = $this->title;
$session = Yii::$app->session;

$gridColumns = [
    ['class' => 'yii\grid\SerialColumn'],

    'first_name',
    'other_name',
    'last_name',
    'email',
    [
        'attribute' => 'role',
        'value' => function($model) {
            return Role::findOne(['id' => $model->role])->name;
        }
    ],
    [
        'attribute' => 'status',
        'value' => function($model) {
            if($model->status == 0) {
                return "Deleted";
            } else if($model->status == 8) {
                return "Inactive";
            } else if($model->status == 9) {
                return "Active";
            }
        }
    ],

    ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
        'buttons'  => [
            'view' => function ($url, $model) {
                return Html::a('<span class="fa fa-eye"></span>', ['user/view', 'id' => $model->id],
                    ['title' => 'View']);
            },
            'update' => function ($url, $model) {
                return Html::a('<span class="fa fa-pencil-alt"></span>', ['user/update', 'id' => $model->id],
                    ['title' => 'Update']);
            },
            'activate' => function ($url, $model) {
                 if($model->status == 8) {
                    return Html::a('<span class="fa fa-check"</span>', ['user/activate-user', 'id' => $model->id],
                    ['title' => 'Activate']);
                 }else if($model->status == 9){
                     return Html::a('<span class="fa-thin fa-xmark"</span>', ['user/activate-user', 'id' => $model->id],
                    ['title' => 'De-activate']);
                 }
                     
            },
            'delete' => function ($url, $model) {
                if($model->status == 8 || $model->status == 9) {
                    return Html::a('<span class="fa fa-trash"></span>', Url::to(['user/delete', 'id' => $model->id]), [
                        'title' => 'Delete',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this user?'),
                        'data-method' => 'post',
                    ]);
                } else if($model->status == 0) {
                    return Html::a('<span class="fa fa-redo"></span>', Url::to(['user/restore', 'id' => $model->id]), [
                        'title' => 'Restore',
                        'data-confirm' => Yii::t('yii', 'Are you sure you want to restore this user?'),
                        'data-method' => 'post',
                    ]);
                }
            },
        ],
        'template' => '{view} {update} {delete} {activate}'],
];
?>
<div class="card shadow">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
        <?= ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,

            'dropdownOptions' => [
                'label' => 'Export',
                'class' => 'btn btn-success'
            ],
            'filename' => 'CMS - Users - '.date("d-m-Y"),
            'exportConfig' => [
                ExportMenu::FORMAT_PDF => [
                    'pdfConfig' => [
                        'methods' => [
                            'SetHeader' => ['University SDA Church - CMS users'],
                            'SetFooter' => ['{PAGENO}' . ' Copyright - University SDA CMS'],
                            'SetSubject' => ['CMS User'],
                            'SetAuthor' => [$session['name']],
                        ],
                    ],
                ],
            ],
        ]) ?>
        <?= Html::a('Manage User Roles', ['role/index'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Activate All Users', ['user/activate-users'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php Pjax::begin(); ?>

            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
    ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>