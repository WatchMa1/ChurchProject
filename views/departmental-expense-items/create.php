<?php

use app\models\FundItems;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DepartmentalExpenseItems */

$this->title = 'Add Departmental Expense Item';
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Reports','url' => ['/financial-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Departmental Expense Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departmental-expense-items-create">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php 
    $year = Yii::$app->getRequest()->getQueryParam('year');  
    if (strlen($year) == 4) {
        echo $this->render('_form', [
            'model' => $model,
        ]);
    } else {
        echo '<span class="h5">Choose year</span>';
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
                echo  '<span class="mx-2">'.Html::a($curYearIteration, ['/departmental-expense-items/create','year' => $curYearIteration], ['class' => 'my-1 btn btn-dark']).'</span>' ;
                }
            }
            echo '</div>';
                
        }
        
    }   




?>


</div>