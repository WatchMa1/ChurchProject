<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Family */

$this->title = 'Family Details';
$this->params['breadcrumbs'][] = 'Family Details';
$this->params['help'] = '<ul><li>Required fields are marked with a red asterisk(<span class="required">*</span>)</li></ul>';
?>
<div class="card shadow">
    <div class="card-header">
        <?= Html::a('<i class="fa fa-arrow-left"></i> Return to Family Details', ['family/view'],
            ['class' => 'btn btn-info']); ?>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
