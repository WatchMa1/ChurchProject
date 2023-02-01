<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Member;
use app\models\Department;


/* @var $this yii\web\View */
/* @var $model app\models\DepartmentMember */

$this->title = 'Department Member';
$this->params['breadcrumbs'][] = ['label' => 'Department Members', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$this->params['help'] = '<ul><li>Contact admin for help.</li></ul>';
?>
<div class="department-member-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'member',
                'value' => function($model) {
                    $dep_member = Member::findOne(['id' => $model->member]);
                    $dep_member_first_name = is_object($dep_member) ? $dep_member->first_name : '';
                    $dep_member_last_name = is_object($dep_member) ? $dep_member->last_name : '';
                    $dep_member_full_name = $dep_member_first_name.' '.$dep_member_last_name;
                    return $dep_member_full_name;
                }
            ],
            [
                'attribute' => 'department',
                'value' => function($model) {
                    return Department::findOne(['id' => $model->department])->name;
                }
            ],
            'role',
            'year',
        ],
    ]) ?>

</div>