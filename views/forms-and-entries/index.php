<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\TitheOffering */

$this->title = 'Forms & Entries';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Child Dedication</h5>
                <p class="card-text">Form for child dedications request.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/child-dedication/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Wedding Notice</h5>
                <p class="card-text">Notify the Leadership about your Wedding.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/wedding-notices/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Baptism Interests</h5>
                <p class="card-text">Register for the coming baptism program.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/baptism-interest/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Funeral Notice</h5>
                <p class="card-text">Notify the Leadership about a funeral.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/funeral-notices/index']));?>
            </div>
        </div>
    </div>
    <?php
if (User::userIsAllowedTo('Manage Department') || User::userIsAllowedTo('Manage Users')) {
    ?>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Request Funds</h5>
                <p class="card-text">Fund request form
                </p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/payment-request']));?>

            </div>
        </div>
    </div>
    <?php
}
    ?>

</div>