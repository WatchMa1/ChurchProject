<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\WeddingNotices */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Wedding Notices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="wedding-notices-view">

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
            'groom_first_name',
            'groom_last_name',
            'bride_first_name',
            'bride_last_name',
            'address:ntext',
            'more_info:ntext',
            'wedding_date:date',
            'phone_number',
            'family',
            'groom_church',
            'bride_church',
            'is_bride_baptised',
            'is_groom_baptised',
            'officiating_minister_name',
            'addedBy.fullName',
            [
                'attribute' => 'status',
                'value' => function ($model) {
                    if (isset($model['status'])){
                        $status = $model['status'];
                        switch ($status) {
                            case '1':
                                $state = '<span class="text-primary">Recieved</span>';
                                break;
                            case '2':
                                $state = '<span class="text-success">Done</span>';
                                break;
                            case '0':
                                $state = 'pending';
                                break;
                            default:
                                $state = 'pending';
                                break;
                        }                  
                        return '<span class="font-weight-bold">'.$state.'</span>';
                    } else {
                        return '<em>unset</em>';
                    }
                    },
                'format' => 'html',
            ],
            [
                'attribute'=>'processed_by',
                'value'=> function ($model) {
                        return '<span class="">'.$model->processedBy['fullName'].'</span>';
                    },
                'format'=>'html'
            ],
            'processed_at:date',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>