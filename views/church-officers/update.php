<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchOfficers */

$this->title = 'Update Church Officers: ' . $model->position['name'];
$this->params['breadcrumbs'][] = ['label' => 'Church Officers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->position['name'], 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="church-officers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'isupdate' => true,
    ]) ?>

</div>