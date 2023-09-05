<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Initiative */

$this->title = 'Create Initiative Multiple';
$this->params['breadcrumbs'][] = ['label' => 'Initiatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>If the initiative is a one-day event, then the start and end date should be the same.</li></ul>';


$this->registerJs(
    "function removeItem(i) { 
        if (confirm('Do you want to remove activity '+i+'?')){
            $('#item-'+i).remove();
        }
     }",
    $this::POS_END
);
?>
<div class="initiative-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h5><em>Ignore or Remove Items you dont need.</em></h5>
    <?= $this->render('_form-multiple', [
        'model' => $model,
        'depmembers' => $depmembers,
        'multiModel' => $multiModel,
        'mydep' => $mydep

    ]) ?>

</div>