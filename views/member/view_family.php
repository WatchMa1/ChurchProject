<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = \app\models\Family::findOne(['id' => $id])->family_name." Family";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card shadow">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
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
                        if(\app\models\FamilyChildren::findOne(['child' => $model->id])) {
                            return 'Child';
                        } else if(\app\models\FamilyOther::findOne(['other' => $model->id])) {
                            return 'Other Family Member';
                        } else if(\app\models\Family::findOne(['spouse' => $model->id])){
                            return 'Spouse';
                        } else {
                            return 'Head of Family';
                        }
                    }
                ],
                ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',
                    'buttons'  => [
                        'view' => function ($url, $model) {
                            return Html::a('View', ['member/view', 'id' => $model->id],
                                ['title' => 'View']);
                        },
                    ],
                    'template' => '{view}'],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>
