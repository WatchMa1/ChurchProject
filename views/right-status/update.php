<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RightStatus */

$this->title = 'Update Right Status: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Right Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="right-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
