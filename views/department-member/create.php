<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMember */

$this->title = 'Create Department Member';
$this->params['breadcrumbs'][] = ['label' => 'Department Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="department-member-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'ah' => $ah,
    ]) ?>

</div>
