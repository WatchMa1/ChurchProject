<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */

$this->title = date('l jS \of F Y',strtotime($model->day));
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = ['label' => 'Weekly Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="weekly-schedule-view">

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
            'day:date:Date',
            'theme:ntext',
            'elderOne.fullName:text:Elder On Duty 1',
            'elderTwo.fullName:text:Elder On Duty 2',
            'clerkOne.fullName:text:Clerk On Duty 1',
            'clerkTwo.fullName:text:Clerk On Duty 2',
            'deaconOne.fullName:text:Deacon On Duty 1',
            'deaconTwo.fullName:text:Deacon On Duty 2',
        ],
    ]) ?>

</div>