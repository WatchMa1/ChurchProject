<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RightStatus */

$this->title = 'Add Right';
$this->params['breadcrumbs'][] = ['label' => 'Right Statuses'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="right-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
