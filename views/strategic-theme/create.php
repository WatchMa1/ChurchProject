<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\StrategicTheme */

$this->title = 'Create Strategic Theme';
$this->params['breadcrumbs'][] = ['label' => 'Strategic Themes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="strategic-theme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
