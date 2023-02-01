<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\ChildDedication */

$this->title = $model->child_name;
$this->params['breadcrumbs'][] = ['label' => 'Child Dedications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="child-dedication-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
        if (User::userIsAllowedTo('Manage Users')) { ?>
    <p>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php } ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user.fullName',
            'child_name:ntext',
            'child_gender:ntext',
            'meaning_name:ntext',
            'father_name',
            'mother_name',
            'father_phone',
            'mother_phone',
            'father_email:email',
            'mother_email:email',
            'father_religious_affiliation:ntext',
            'father_adventist_membership:ntext',
            'mother_religious_affiliation:ntext',
            'mother_adventist_membership:ntext',
            //'photo:ntext',
             [
                'attribute' => 'status',
                'value' => function ($model,$key) {
                    if (isset($model['status'])){
                        $state = ($model['status'] == 1) ? 'Approved' : 'pending';                   
                        return '<span class="font-weight-bold">'.$state.'</span>';
                    } else {
                        return '<em>unset</em>';
                    }
                    },
                'format' => 'html',
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>