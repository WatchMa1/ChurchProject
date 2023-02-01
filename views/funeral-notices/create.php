<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FuneralNotices */

$this->title = 'Create Funeral Notices';
$this->params['breadcrumbs'][] = ['label' => 'Funeral Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funeral-notices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
