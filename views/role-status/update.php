<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleStatus */

$this->title = 'Update Leadership History: ';
$this->params['breadcrumbs'][] = ['label' => 'Leadership History', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-status-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
