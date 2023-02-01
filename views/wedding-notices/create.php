<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WeddingNotices */

$this->title = 'Create Wedding Notices';
$this->params['breadcrumbs'][] = ['label' => 'Wedding Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wedding-notices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
