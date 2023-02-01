<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BaptismInterest */

$this->title = 'Register for Baptism';
$this->params['breadcrumbs'][] = ['label' => 'Baptism Interests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baptism-interest-create">

    <h1><?= 'Declare Interest in baptism' ?></h1>
    <h5><?= 'Do you desire to get baptised in the coming Baptism?' ?></h5>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>