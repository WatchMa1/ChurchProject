<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */

$this->title = 'Update Week Bulletin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = ['label' => 'Weekly Bulletins', 'url' => ['bulletins']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view-bulletin', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
\yii\web\YiiAsset::register($this);
?>
<div class="weekly-schedule-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form-bulletin', [
        'model' => $model,
    ]) ?>

</div>