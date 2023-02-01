<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RemindersAndNotices */

$this->title = 'Update Reminders And Notices: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reminders And Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reminders-and-notices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
