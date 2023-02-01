<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchPositions */

$this->title = 'Create Church Positions';
$this->params['breadcrumbs'][] = ['label' => 'Church Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-positions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
