<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Minister */

$this->title = 'Update Minister: ' . $model->minister_id;
$this->params['breadcrumbs'][] = ['label' => 'Ministers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->minister_id, 'url' => ['view', 'id' => $model->minister_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="minister-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'address' => $address,
    ]) ?>

</div>
