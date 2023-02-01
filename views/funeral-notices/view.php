<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\FuneralNotices */

$this->title = $model->first_name.' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Funeral Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="funeral-notices-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'first_name',
            'last_name',
            'gender:ntext',
            'address:ntext',
            'date_of_birth:date',
            'date_of_death:date',
            [
                'attribute' => 'photo',
                'value' =>function ($model){
                    if(!empty($model->photo)) {
                        return Html::img('@web/uploads/funeral_photo/'.$model->photo, ['height'=>'200']);
                    } 
                },
                'format' => 'html',
            ],
            'position_in_church:ntext',
            'family_members_and_contacts:ntext',
            [
                'attribute' => 'notified_by',
                'value' => function($model) {
                    $datamodel = User::findOne(['id' => $model->notified_by]);
                    if (is_object($datamodel)) {
                        return $datamodel->fullName;
                    } else {
                        return '<em>not processed</em>';
                    }                   
                },
                'format' => 'html',
            ],
            [
                'attribute' => 'status',
                'value' => function ($model,$key) {
                    if (isset($model['status'])){
                        $state = ($model['status'] == 1) ? 'Notice Recieved' : 'pending';
                        return '<span class="font-weight-bold text-primary">'.$state.'</span>';
                    } else {
                        return '<em>unset</em>';
                    }
                    },
                'format' => 'html',
            ],
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>