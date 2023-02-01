<?php

use app\models\Department;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RemindersAndNotices */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Reminders And Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="reminders-and-notices-view">

    <h4 class="text-center"><?= Html::encode($this->title) ?></h4>

<div class="shadow px-2 py-1 m-3 rounded">
    <?=  $model->body;    ?>
    <p class="d-flex justify-content-end">
     <span class=""><em>Posted At: <?= ' ' .date('D - jS M, Y H:i',$model->date_of_notice)?></em></span>

    </p>
</div>
<?php
  
  $myDepartment = Yii::$app->session['department'];
  $modelDepartment = $model->audience;
  $modelSendTo = $model->send_to;
 if (User::userIsAllowedTo('Manage Users') || (User::userIsAllowedTo('Manage Department') && $modelDepartment==$myDepartment && $modelSendTo=='department')) {
?>
<p class="d-flex justify-content-end">
    <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn-sm mx-1 btn-primary']) ?>
    <?= Html::a('Delete', ['delete', 'id' => $model->id], [
        'class' => 'btn-sm mx-1 btn-danger',
        'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
        ],
    ]) ?>
</p>
<?php
 }
?> 
<?php
 if (User::userIsAllowedTo('Manage Users')) {
?>
<p class="text-center"> </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'send_to',
            [
                'attribute' => 'audience',
                'value' => function ($model)
                {
                    $send_to = $model->send_to;
                    $audience = $model->audience;
                    if ($send_to == 'all') {
                        return 'all';
                    } else {
                       $department = Department::findOne($audience);
                       return $department->name;
                    }
                    
                }
            ],
            [
                'attribute' => 'status',
                'value' => function ($model)
                {
                    $status = $model->status;
                    switch ($status) {
                        case '1':
                            $state = 'Published';
                            break;
                        case '0':
                            $state = 'Not published';
                            break;
                        default:
                            $state = 'Not published';
                            break;
                    }
                    return $state;
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'addedBy.fullName:text:Added By',
        ],
    ]) ?>
<?php
 }
?>
</div>
