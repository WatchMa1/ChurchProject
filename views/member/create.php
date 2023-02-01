<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $membership app\models\MembershipStatus */
/* @var $address app\models\Address */
/* @var $work app\models\WorkPlace */

$this->title = 'Create Profile';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Required fields are marked with a red asterisk(<span class="required">*</span>)</li></ul>';
?>
    <?= $this->render('_form', [
        'model' => $model,
        'membership' => $membership,
        'address' => $address,
        'work' => $work
    ]) ?>

