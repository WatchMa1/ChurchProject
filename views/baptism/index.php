<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BaptismSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Baptisms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baptism-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Baptism', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'baptism_id',
            'date',
            'baptising_minister',
            'member_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
