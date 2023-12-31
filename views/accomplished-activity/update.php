<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccomplishedActivity */

$this->title = 'Update Accomplished Activity: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Accomplished Activities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="accomplished-activity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
