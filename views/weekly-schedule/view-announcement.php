<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */

$this->title = 'Announcements on '.date('D M, Y',strtotime($model->day));
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = ['label' => 'Weekly Announcements', 'url' => ['announcements']];

$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="weekly-schedule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update-announcement', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'day:date:Date',
            'theme:ntext',
            'announcements:html:General Announcements',
            'cares_concern:html:Concerns and Cares',
        ],
    ]) ?>

</div>