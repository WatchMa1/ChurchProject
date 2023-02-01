<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Family */

$this->title = 'Define Family';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Required fields are marked with a red asterisk (<span class="required">*</span>).</li></ul>';
?>
<div class="card shadow">
    <div class="card-header"><?= Html::encode($this->title) ?></div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
