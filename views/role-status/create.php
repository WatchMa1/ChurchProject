<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RoleStatus */

$this->title = 'Create Leardership History';
$this->params['breadcrumbs'][] = ['label' => 'Leadership History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-status-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
