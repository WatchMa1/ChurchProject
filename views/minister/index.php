<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MinisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ministers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minister-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Minister', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'minister_id',
            'first_name',
            'other_name',
            'last_name',
            'address.home_address',
            'address.mobile_number',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
