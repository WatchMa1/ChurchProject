<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Initiative */

$this->title = 'Create Initiative';
$this->params['breadcrumbs'][] = ['label' => 'Initiatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>If the initiative is a one-day event, then the start and end date should be the same.</li></ul>';
?>
<div class="initiative-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'depmembers' => $depmembers,
        'mydep' => $mydep

    ]) ?>

</div>