<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchOfficers */

$this->title = $model->position['name'];
$this->params['breadcrumbs'][] = ['label' => 'Church Officers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="church-officers-view">

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
            'id',
            [
                'attribute' => 'position_id',
                'label'=>'Position',
                'value' =>$model->position['name'],
                'format' => 'html',
            ],
            'user.fullName:text:Member',
            'year',
            'addedBy.fullName:text:Added By',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>