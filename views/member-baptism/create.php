<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MemberBaptism */

$this->title = 'Create Member Baptism';
$this->params['breadcrumbs'][] = ['label' => 'Member Baptisms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-baptism-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
