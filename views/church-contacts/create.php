<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChurchContacts */

$this->title = 'Add Church Contacts';
$this->params['breadcrumbs'][] = ['label' => 'Church Contacts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="church-contacts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>