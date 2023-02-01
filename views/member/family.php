<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = ucwords(\app\models\Family::findOne(['id' => Yii::$app->session['family']])->family_name);
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click one of the buttons below to add the corresponding member type under your family.</li></ul>';
?>
<div class="card shadow">
    <div class="card-header">
        <?php if(\app\models\Member::findOne(['id' => Yii::$app->session['member']])->marital_status == 'Married') { ?>
            <?php if(!isset(\app\models\Family::findOne(['id' => Yii::$app->session['family']])->spouse)) { ?>
                <?= Html::a('Add Spouse', ['create-family-spouse'], ['class' => 'btn btn-success']) ?>
            <?php } ?>
        <?php }?>
        <?= Html::a('Add Child', ['create-family-child'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Add Other Family Member', ['create-family-other'], ['class' => 'btn btn-success']) ?>
    </div>
    <div class="card-body">
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'label' => 'Name',
                'value' => function($model) {
                    return $model->getFullName();
                }
            ],
            [
                    'label' => 'Status',
                'value' => function($model) {
                    if($model->id == Yii::$app->session['member']) {
                        return 'Head of Family';
                    } else if(\app\models\FamilyChildren::findOne(['child' => $model->id])) {
                        return 'Child';
                    } else if(\app\models\FamilyOther::findOne(['other' => $model->id])) {
                        return 'Other Family Member';
                    } else if($model->id == \app\models\Family::findOne(['id' => Yii::$app->session['family']])->spouse) {
                        return 'Spouse';
                    }
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
                    'delete' => function ($url, $model) {
                        if($model->id != Yii::$app->session['member']) {
                            return Html::a('<span class="fa fa-trash"></span>', Url::to(['member/delete', 'id' => $model->id]), [
                                'title' => 'Delete',
                                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this member?'),
                                'data-method' => 'post',
                            ]);
                        }
                    },
                ],
                'template' => '{view} {update} {delete}'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    </div>
</div>
