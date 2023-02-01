<?php

use app\models\FundItems;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpenses */
/* @var $form yii\widgets\ActiveForm */


$this->title = 'Choose Year';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="departmental-expenditure">

    <div class="mb-3">
        <h4>Choose the Year for the report you want</h4>
        <?php 
            $fundyearData = FundItems::find()->select('year')->distinct()->all();
            $num_of_fund_items = count($fundyearData);
                if ($num_of_fund_items == 0) {
                    echo '<div class="p-3 border rounded">
                    <span class="font-weight-bold">There are no fund items found for the year '.$year.' <br> Please start by adding Fund Items for '.$year.'. </span> '.Html::a('Add Fund Item', ['fund-items/create'], ['class' => 'btn btn-success']).'
                    </div>';
                } else {
                    echo '<div class="p-3 border rounded">';
                    foreach ($fundyearData as $row) {
                        $curYearIteration = $row['year'];
                        if ($curYearIteration) {
                        echo  '<span class="mx-2">'.Html::a($curYearIteration, [$url,'year' => $curYearIteration], ['class' => 'my-1 btn btn-dark']).'</span>' ;
                        }
                    }
                    echo '</div>';
                       
                }
        ?>
    </div>


</div>