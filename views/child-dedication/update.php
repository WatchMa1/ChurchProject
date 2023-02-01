<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChildDedication */

$this->title = 'Update Child Dedication: ' . $model->child_name;
$this->params['breadcrumbs'][] = ['label' => 'Child Dedications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="child-dedication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>