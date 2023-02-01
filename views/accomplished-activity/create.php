<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AccomplishedActivity */

$this->title = 'Report an Activity';
?>
<div class="accomplished-activity-create" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
