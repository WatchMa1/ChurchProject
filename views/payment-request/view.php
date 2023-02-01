<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\UserSignatures;

/* @var $this yii\web\View */
/* @var $model app\models\PaymentRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Payment Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payment-request-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if (User::userIsAllowedTo('Manage Users')) { ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update Status', ['update-state', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
    }
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'requested_by',
                'value' => function($model) {
                    $datamodel = User::findOne(['id' => $model->requested_by]);
                    if (is_object($datamodel)) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>not found</em>';
                    }
                }
            ],
            [
                'attribute' => 'department',
                'value' => function ($model) {
                    if (is_object($model['department0'])){
                        $fullname = $model['department0']->name;                   
                        return '<span class="font-weight-bold">'.$fullname.'</span>';
                    } else {
                        return '<em>not assigned</em>';
                    }
                    },
                'format' => 'html',
            ],
            'amount',
            'strategic_area:ntext',
            'date_required:date',
            'payment_to_be_made_to',
            'purpose:ntext',
            'requested_at:date',
            'processed_at:date',
            //'status:ntext',
            [
                'attribute' => 'status',
                'value' => function($model) {
                    $data = $model->status;
                    $data2 = ($model->processed_at) ? date('j M Y', $model->processed_at) : '?-?-?';
                    switch ($data) {
                        case '3':
                            $dataname = '<span class="text-danger"><b>Rejected ('.$data2.')</b></span>';
                            break;
                        case '2':
                            $dataname = '<span class="text-success"><b>Processed ('.$data2.')</b></span>';
                            break;
                        case '1':
                            $dataname = '<span class="text-warning"><b>Approved, not yet Proccessed</b></span>';
                            break;
                        case '0':
                            $dataname = '<span class="text-secondary"><b>Awaiting approval</b></span>';
                            break;
                        default:
                            $dataname = '<span class="text-"><b>Awaiting approval</b></span>';
                            break;
                    }
                    if ($dataname) {
                        return '<em>'.$dataname.'</em>';
                    } else {
                        return '<em>not found</em>';
                    }
                },
                'format' => 'html',

            ],
            [
                'attribute' => 'processed_by',
                'value' => function($model) {
                    $data = $model->status;
                    $datamodel = User::findOne(['id' => $model->processed_by]);
                    if (is_object($datamodel)) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>not processed</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'Signature',
                'value' => function($model) {
                    $data = $model->status;
                    $datamodel = UserSignatures::findOne(['user_id' => $model->processed_by]);
                    if (is_object($datamodel)) {
                        return Html::img('@web/uploads/user_signature/'.$datamodel->signature, ['height'=>'100']);
                    } else {
                        return '<em>not set</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'processed_amount',
                'value' => function($model) {
                    $data = $model->status;
                    $data2 = $model->processed_amount;
                    switch ($data) {
                        case '3':
                            $dataname = '<span class="text-danger"><b>Rejected</b></span>';
                            break;
                        case '2':
                            $dataname = '<span class="text-success"><b>'.$data2.'</b></span>';
                            break;
                        case '1':
                            $dataname = '<span class="text-warning"><b>Approved, not yet Proccessed</b></span>';
                            break;
                        case '0':
                            $dataname = '<span class="text-secondary"><b>Awaiting approval</b></span>';
                            break;
                        default:
                            $dataname = '<span class="text-"><b>Awaiting approval</b></span>';
                            break;
                    }
                    if ($dataname) {
                        return '<em>'.$dataname.'</em>';
                    } else {
                        return '<em>not found</em>';
                    }
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'processed_comment',
                'value' => function($model) {
                    $data = $model->processed_comment;
                    if (isset($data) && $data != null) {
                        return $data;
                    } else {
                        return '<em>no comment</em>';
                    }                   
                },
                'format' => 'html',
            ],
           
        ],
    ]) ?>

</div>