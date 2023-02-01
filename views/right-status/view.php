<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RightStatus */

$this->title = app\models\Role::findOne(['id' => $model->role])->name;
$this->params['breadcrumbs'][] = ['label' => 'Right Statuses'];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="right-status-view">

    <h1><?= Html::encode($this->title) ?></h1>

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
              'attribute' => 'role',
              'value' => app\models\Role::findOne(['id' => $model->role])->name,
            ],
            [
              'attribute' => 'right',
              'value' => app\models\Right::findOne(['id' => $model->role])->name,
            ],
            //'status',
            //'created_by',
            //'created_at',
            //'updated_by',
            //'updated_at',
        ],
    ]) ?>

</div>
