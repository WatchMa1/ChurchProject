<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeeklySchedule */

$this->title = 'Create Week Schedule';
$this->params['breadcrumbs'][] = ['label' => 'Manage Schedules', 'url' => ['/manage-schedule']];
$this->params['breadcrumbs'][] = ['label' => 'Weekly Schedules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weekly-schedule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>