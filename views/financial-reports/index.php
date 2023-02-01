<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */



$this->title = 'Financial Reports';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<h1><?= Html::encode($this->title) ?></h1>
<h5>Select The Report you wan to access</h5>

<p>
<ol>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Tithe and Offering - Member Reciepts</span>',Url::to(['tithe-and-offering-per-member']));?>
    </li>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Trust Funds - Aggregated Income Summary</span>',Url::to(['trust-funds-aggregated-summary']));?>
    </li>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Local Funds - Aggregated Income Summary</span>',Url::to(['local-funds-aggregated-summary']));?>
    </li>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Local Funds - Expenditure Summary</span>',Url::to(['local-funds-expenditure-summary']));?>
    </li>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Departmental Expenditure - Monthly</span>',Url::to(['monthly-departmental-expenditure']));?>
    </li>
    <li class="my-2">
        <?php echo Html::a('<span class="font-weight-bold">Departmental Expenditure - Annual</span>',Url::to(['departmental-expenditure']));?>
    </li>

</ol>
</p>