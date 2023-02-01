<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserSignatures */

$this->title = 'Add Signature';
$this->params['breadcrumbs'][] = ['label' => 'User Signatures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-signatures-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>