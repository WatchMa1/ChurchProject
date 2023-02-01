<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */

$this->title = 'New Incomes And Expenses';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Incomes And Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $year];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="incomes-and-expenses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'year' => $year
    ]) ?>

</div>