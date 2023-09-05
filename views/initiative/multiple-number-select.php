<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Initiative */

$this->title = 'Create Initiative';
$this->params['breadcrumbs'][] = ['label' => 'Initiatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>If the initiative is a one-day event, then the start and end date should be the same.</li></ul>';
?>
<div class="initiative-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-6">
            <form action="" method="get">
                <div class="mb3">
                    <label for="">Number of Items to be added</label>
                    <input name="n" class="form-control" value="3" type="number">
                    <button type="submit" class=" btn btn-primary w-100">GO <i class="fas fa-arrow-right"></i></button>
                </div>
            </form>
        </div>
    </div>


</div>