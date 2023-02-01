<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */

$this->title = 'Bulletin for '.date('D M, Y',strtotime($model->day));
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = ['label' => 'Weekly Bulletins', 'url' => ['bulletins']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="weekly-schedule-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update-bulletin', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'day:date:Date',
            'theme:ntext',
            'sabbath_school:html',
            'main_service:html',
            'afternoon_service:html',
            'health_message:html',
        ],
    ]) ?>

</div>