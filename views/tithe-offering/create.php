<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TitheOffering */

$this->title = 'Create Tithe Offering';
$this->params['breadcrumbs'][] = ['label' => 'Tithe Offerings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tithe-offering-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
