<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Baptism */

$this->title = 'Create Baptism';
$this->params['breadcrumbs'][] = ['label' => 'Baptisms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baptism-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
