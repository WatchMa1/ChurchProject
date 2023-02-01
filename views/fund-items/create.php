<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FundItems */

$this->title = 'Add Fund Item';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Fund Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fund-items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>