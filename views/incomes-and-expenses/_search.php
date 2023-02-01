<?php

use app\models\FundItems;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\IncomesAndExpensesSearch */
/* @var $form yii\widgets\ActiveForm */
if (User::userIsAllowedTo('Manage Users')) {
    $fund_items_arr = FundItems::find()->asArray()->all();
} else {
    $dept = Yii::$app->session['department'];
    $fund_items_arr = FundItems::find()->where(['dept'=>$dept])->asArray()->all();
}
?>

<div class="incomes-and-expenses-search">
    <div id="accordionsearch">
        <div class="card">
            <div class="" id="searchbytranstype">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                        aria-controls="collapseOne">
                        Search or Filter Entries
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse collapsed" aria-labelledby="searchbytranstype"
                data-parent="#accordionsearch">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                ]); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <label for=""><em>Search By Fund Item</em></label>

                            <?= $form->field($model, 'fund_item')->dropDownList(\yii\helpers\ArrayHelper::map($fund_items_arr,
                        'id', 'item_name'), ['id' => 'item_name'])->label(false) ?>
                        </div>
                    </div>

                    <label for=""><em>Search By Date Range</em></label>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date [FROM]</label><input type="date" class="form-control"
                                    name="date_of_trans_from" id="date_of_trans_from">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Date [UP TO]</label><input type="date" value="<?= date('Y-m-d', time())?>"
                                    class="form-control" name="date_of_trans_to" id="date_of_trans_to">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                        <?= Html::a('Reset',['/incomes-and-expenses'], ['class' => 'btn btn-secondary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>

    </div>


</div>