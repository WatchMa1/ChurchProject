<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\BaptismInterest */

$this->title = $model->user0->fullname;
$this->params['breadcrumbs'][] = ['label' => 'Baptism Interests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="baptism-interest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Remove', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'user0.fullName:text:Full Name',
            [
                'attribute' => 'state',
                'value' => function($model) {
                    $datamodel =  $model->state;
                    switch ($datamodel) {
                        case '0':
                            $stateText = '<em>pending</em>';
                            break;
                        case '1':
                            $stateText = '<em>recieved</em>';
                            break;                        
                        default:
                            $stateText = '<em>pending</em>';
                            break;
                    }
                    if ($datamodel == 1) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>pending</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'recieved_by',
                'value' => function($model) {
                    $datamodel = User::findOne(['id' => $model->recieved_by]);
                    if (is_object($datamodel)) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>pending</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'return_comment',
                'value' => function($model) {
                    $datamodel = $model->return_comment;
                    if (isset($datamodel)) {
                        return '<em>'.$datamodel.'</em>';
                    } else {
                        return '<em>pending</em>';
                    }                   
                },
                'format' => 'html',
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>