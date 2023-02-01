<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchOfficers */

$this->title = 'Add Church Officer';
$this->params['breadcrumbs'][] = ['label' => 'Church Officers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-officers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>