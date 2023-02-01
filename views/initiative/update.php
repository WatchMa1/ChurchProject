<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Initiative */

$this->title = 'Update Initiative: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Initiatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$this->params['help'] = '<ul><li>If the initiative is a one-day event, then the start and end date should be the same.</li></ul>';
?>
<div class="initiative-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
