<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update ' . $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card shadow">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
    </div>
    <?= $this->render('_formAdmin', [
        'model' => $model,
	'rolestatus' => $rolestatus,
    ]) ?>

</div>
