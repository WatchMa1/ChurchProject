<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RemindersAndNotices */

$this->title = 'Create Reminders And Notices';
$this->params['breadcrumbs'][] = ['label' => 'Reminders And Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$model->date_of_notice = time();
?>
<div class="reminders-and-notices-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
