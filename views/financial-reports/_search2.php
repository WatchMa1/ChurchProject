<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use MP\SelectModel\MPModelSelect;

/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpensesSearch */
/* @var $form yii\widgets\ActiveForm */
function validateDate($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
    return $d && $d->format($format) === $date;
}
$date_of_receipt_to = Yii::$app->getRequest()->getQueryParam('date_of_receipt_to');
$date_of_receipt_from = Yii::$app->getRequest()->getQueryParam('date_of_receipt_from');

?>

<div class="incomes-and-expenses-search">
    <div id="accordionsearch">

        <div class="card">
            <div class="" id="searchbytranstype">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Search By Date Range
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse collapsed" aria-labelledby="searchbytranstype"
                data-parent="#accordionsearch">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                    'action' => [$url],
                    'method' => 'get',
                ]); ?>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date [FROM]</label><input type="date" class="form-control"
                                    name="date_of_receipt_from" id="date_of_receipt_from">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date [UP TO]</label><input type="date" value="<?= date('Y-m-d', time())?>"
                                    class="form-control" name="date_of_receipt_to" id="date_of_receipt_to">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Reset',[$url], ['class' => 'btn btn-secondary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>

    <div class="mb-2 text-center">


        <?php 
        echo '<strong>Showing Entries ';
        if ($date_of_receipt_from) {
            echo 'FROM <u>'.date('d M, Y',strtotime($date_of_receipt_from)).'</u>';
        } else {
            echo '';
        }
        if ($date_of_receipt_to) {
            echo ' UPTO <u>'.date('d M, Y',strtotime($date_of_receipt_to)).'</u>';
        } else {
            echo ' till date';
        }
        echo '</strong>';

    ?>
    </div>
</div>