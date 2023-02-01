<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrategicPlan */

$this->title = 'Create Strategic Plan';
?>
<div class="strategic-plan-create" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
