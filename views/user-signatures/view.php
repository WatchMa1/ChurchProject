<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserSignatures */

$this->title = $model->user['fullName'];
$this->params['breadcrumbs'][] = ['label' => 'User Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-signatures-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete'], [
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
            'user.fullName',
            [
                'attribute' => 'signature',
                'value' =>function ($model){
                    if(!empty($model->signature)) {
                        return Html::img('@web/uploads/user_signature/'.$model->signature, ['height'=>'100']);
                    } else {
                        return '<span class="font-weight-bold"><em>not set. please add signature</em></span>';
                    }
                },
                'format' => 'html',
            ],
            
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>