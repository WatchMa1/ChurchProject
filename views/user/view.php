<?php

use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->getFullName();
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card shadow">
    <div class="card-header">
        <h4><?= Html::encode($this->title) ?></h4>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->status == 8 || $model->status == 9) { ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this user?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
        <?php if($model->status == 0) { ?>
        <?= Html::a('Restore', ['restore', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to restore this user?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
        <?php if($model->status == 9) { ?>
        <?= Html::a('De-activate', ['deactivate', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to de-activate this user?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
        <?php if($model->status == 8) { ?>
        <?= Html::a('Activate', ['activate-user', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Are you sure you want to activate this user?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php } ?>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'first_name',
            'other_name',
            'last_name',
            'email:email',
            [
                'attribute' => 'role',
                'value' => function($model) {
                    $rolemodel = Role::findOne(['id' => $model->role]);
                    if (is_object($rolemodel)) {
                        return $rolemodel->name;
                    } else {
                        return '<em>not found</em>';
                    }
                }
            ],
            [
                'attribute' => 'status',
                'value' => function($model) {
                    if($model->status == 0) {
                        return "Deleted";
                    } else if($model->status == 8) {
                        return "Inactive";
                    } else if($model->status == 9) {
                        return "Active";
                    }
                }
            ],
            'created_at:date',
            'updated_at:date',
            [
                'attribute' => 'updated_by',
                'value' => function($model) {
                    return User::findOne(['id' => $model->updated_by])->getFullName();
                }
            ],
        ],
    ]) ?>
    </div>
</div>