<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LeadershipHistory */

$this->title = 'Create Leadership History';
$this->params['breadcrumbs'][] = ['label' => 'Leadership Histories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leadership-history-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
