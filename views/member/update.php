<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $membership app\models\MembershipStatus */
/* @var $address app\models\Address */
/* @var $work app\models\WorkPlace */

$this->title = 'Update Profile';
$this->params['breadcrumbs'][] = 'Update';
$this->params['help'] = '<ul><li>Required fields are marked with a red asterisk(<span class="required">*</span>)</li></ul>';
$js1 = "$(document).ready(function() { $('#status').val(".$membership->status.").trigger('change').trigger('depdrop:change'); setTimeout(function(){ ready(); }, 1000);});";
$js2 = "function ready() { $('#membershipstatus-type').val(".$membership->type.");}";
$script = <<< JS
    $js2
    $js1
JS;
$this->registerJs($script);
?>
<?= $this->render('_form', [
    'model' => $model,
    'membership' => $membership,
    'address' => $address,
    'work' => $work
]) ?>
