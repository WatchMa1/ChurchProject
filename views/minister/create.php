<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Minister */

$this->title = 'Create Minister';
$this->params['breadcrumbs'][] = ['label' => 'Ministers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="minister-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
    ]) ?>

</div>
