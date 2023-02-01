<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Role;
use app\models\Club;
use app\models\Department;


/* @var $this yii\web\View */
/* @var $model app\models\RoleStatus */

$this->title = 'View';
$this->params['breadcrumbs'][] = ['label' => 'Leadership History', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="role-status-view">

    <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
                'attribute' => 'user',
                'value' => function($model) {
                    return User::findOne(['id' => $model->user])->first_name . ' ' . ' ' . User::findOne(['id' => $model->user])->other_name . User::findOne(['id' => $model->user])->last_name;
                }
            ],
            [
                'attribute' => 'role',
                'value' => function($model) {
                    return Role::findOne(['id' => $model->role])->name;
                }
            ],
            [
                'attribute' => 'department',
                'value' => function($model) {
                    return Department::findOne(['id' => $model->department])->name;
                }
            ],
            
            'year',
        ],
    ]) ?>

</div>
