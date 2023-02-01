<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OfferingAndTithe */

$this->title = 'Enter New Tithe Offering Receipt';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Offering And Tithes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$min = $year.'01-01';
$max = $year.'12-31';
?>
<div class="offering-and-tithe-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'year' => $year,
    ]) ?>

</div>