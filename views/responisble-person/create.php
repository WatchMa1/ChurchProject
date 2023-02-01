<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ResponsiblePerson */

$this->title = 'Create Responsible Person';
$this->params['breadcrumbs'][] = ['label' => 'Responsible People', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="responsible-person-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
