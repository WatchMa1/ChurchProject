<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSignaturesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Signatures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-signatures-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add Signature', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user.fullName',
            [
                'attribute' => 'signature',
                'value' =>function ($model){
                    if(!empty($model->signature)) {
                        return Html::img('@web/uploads/user_signature/'.$model->signature, ['height'=>'200']);
                    } else {
                        return '<span class="font-weight-bold"><em>not set. please add signature</em></span>';
                    }
                },
                'format' => 'html',
            ],
            
            'created_at:date',
            'updated_at:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>