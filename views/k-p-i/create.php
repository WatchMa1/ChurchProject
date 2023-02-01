<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KPI */

$this->title = 'Create KPI';
$this->params['breadcrumbs'][] = ['label' => 'Kpis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kpi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
         'model' => $model,
    ]) ?>

</div>
