<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Initiative */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Initiatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Update</button> to make changes to the initiative.</li></ul>';
?>
<div class="initiative-view">

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
            'activity:ntext',
            'start_date:date',
            'end_date:date',
            'budget',
            'responsible.fullName:ntext:Responsible Person',
            'strategicObjective.objectives',
            'comments',
        ],
    ]) ?>

</div>