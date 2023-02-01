<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrategicObjective */

$this->title = 'Create Strategic Objectives';
$this->params['breadcrumbs'][] = ['label' => 'Strategic Objectives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategic-objective-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
