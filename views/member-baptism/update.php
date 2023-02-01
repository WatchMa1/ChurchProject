<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MemberBaptism */

$this->title = 'Update Member Baptism: ' . $model->member_baptism_id;
$this->params['breadcrumbs'][] = ['label' => 'Member Baptisms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->member_baptism_id, 'url' => ['view', 'id' => $model->member_baptism_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="member-baptism-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
