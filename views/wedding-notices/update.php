<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeddingNotices */

$this->title = 'Update Wedding Notices: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wedding Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$model->wedding_date = date('Y-m-d',$model->wedding_date);

?>
<div class="wedding-notices-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>