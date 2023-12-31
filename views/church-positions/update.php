<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchPositions */

$this->title = 'Update Church Positions: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Church Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';



?>
<div class="church-positions-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>