<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RemindersAndNoticesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reminders-and-notices-search" id="accordionsearch">

    <div class="card">
        <div class="" id="searchTitle">
            <h5 class="mb-0">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseOne">
                    Search
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse collapsed" aria-labelledby="searchTitle"
            data-parent="#accordionsearch">
            <div class="card-body">
                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                    <div class="form-group">
                        <?= $form->field($model, 'title')->label(false) ?>
                        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= Html::a('Reset', ['index'], ['class' => 'btn btn-sm btn-outline-dark']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            
            </div>
        </div>
    </div>

    
</div>
