<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MemberBaptismSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Member Baptisms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-baptism-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Member Baptism', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'member_baptism_id',
            'member_id',
            'baptism_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
