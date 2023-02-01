<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\TitheOffering */

$this->title = 'Finance Entries & Reports';
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
<?php
if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
    ?>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Tithe and Offering</h5>
                <p class="card-text">Entries / Reciepts of tithes and offerings from members.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/offering-and-tithe/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Fund Items (accounts)</h5>
                <p class="card-text">Manage (add, update & delete) YEARLY fund accounts and their yearly budgets.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/fund-items/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Incomes & Expenditure</h5>
                <p class="card-text">Manage entries of income and expenses incurred on fund accounts.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/incomes-and-expenses/index']));?>
            </div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Financial Reports</h5>
                <p class="card-text">Generate periodic reports of tithes & offering, departmental expenditure, local
                    trust funds, etc.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/financial-reports/index']));?>
            </div>
        </div>
    </div>
<?php 
} 
?> 

    <?php
if (User::userIsAllowedTo('Manage Department')) {
    ?>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title">Departmental Incomes & Expenditure </h5>
                <p class="card-text">Manage entries of income and expenses incurred on fund accounts under your department.</p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/incomes-and-expenses/index']));?>
            </div>
        </div>
    </div>
<?php 
} 
?> 



    <?php
if (User::userIsAllowedTo('Manage Department') || User::userIsAllowedTo('Manage Users')) {
    ?>
    <div class="col-md-6 mb-3">
        <div class="card" style="width: 95%;">
            <div class="card-body">
                <h5 class="card-title"> Fund Requests</h5>
                <p class="card-text">Management and approvals of Fund requests from departments
                </p>
                <?php echo Html::a('<span class="font-weight-bold btn btn-block btn-primary">OPEN</span>',Url::to(['/payment-request']));?>

            </div>
        </div>
    </div>
    <?php
}
    ?>

</div>