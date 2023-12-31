<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserSignatures */

$this->title = 'Update User Signatures: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-signatures-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
