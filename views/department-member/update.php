<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMember */

$this->title = 'Update Department Member: ' . $member->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Department Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $member->getFullName(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="department-member-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ah' => $ah,
    ]) ?>

</div>
