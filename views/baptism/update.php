<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baptism */

$this->title = 'Update Baptism: ' . $model->baptism_id;
$this->params['breadcrumbs'][] = ['label' => 'Baptisms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->baptism_id, 'url' => ['view', 'id' => $model->baptism_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="baptism-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
