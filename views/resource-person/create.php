<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResourcePerson */

$this->title = 'Create Resource Person';
$this->params['breadcrumbs'][] = ['label' => 'Resource People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resource-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
