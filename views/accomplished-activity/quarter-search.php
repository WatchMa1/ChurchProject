<?php


use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use kartik\mpdf\Pdf;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\export\ExportMenu;
use app\models\KPI;
use app\models\Department;
use yii\helpers\Url;

use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AccomplishedActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$department = Department::findOne(['id' => $dept]);
$this->title = 'Select Quarter';
$this->params['breadcrumbs'][] = $department->name . ' Report';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="accomplished-activity-create" align="center">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_select-quarter', [
        'value' => $value,
        'dept' => $dept
        
    ]) ?>
    <?php if (User::userIsAllowedTo('Manage Department')) {?>
    <div class="my-3">
        <span>Not having report?</span>
        <?= Html::a('Report an Activity',['/accomplished-activity/create'], ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php }?>

</div>