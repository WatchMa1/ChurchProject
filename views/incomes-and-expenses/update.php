<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */

$this->title = 'Update Incomes And Expenses: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Incomes And Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $year];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$model->date_of_trans = date('Y-m-d', $model->date_of_trans);
?>
<div class="incomes-and-expenses-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'year' => $year,
    ]) ?>

</div>