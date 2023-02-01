<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChildDedication */

$this->title = 'Create Child Dedication';
$this->params['breadcrumbs'][] = ['label' => 'Child Dedications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="child-dedication-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
