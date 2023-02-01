<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $membership app\models\MembershipStatus */
/* @var $address app\models\Address */
/* @var $work app\models\WorkPlace */
$user = User::findOne(User::getCurrentUserID());


$this->title = $model->title.' '.ucwords($model->first_name).' '.ucwords($model->other_name).' '. ucwords($model->last_name);
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Update</button> to edit the Member Details.</li></ul>';
if(isset($address)) {
    //list($latitude, $longitude) = explode(',', $address->gps_home_location);
}
\yii\web\YiiAsset::register($this);
?>
<div class="card shadow">
    <?php if (User::userIsAllowedTo('Manage Department')) { ?>
    <div class="card-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if($model->id != Yii::$app->session['member']) { ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </div>
    <?php }?>
    
    <div class="card-body">
        <h4>Member Details</h4>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
                [
                        'label' => 'Name',
                    'value' => function($model) {
                        return $model->title.' '.ucwords($model->first_name).' '.ucwords($model->other_name).' '.
                            ucwords($model->last_name);
                    }
                ],
            [
                    'attribute' => 'maiden_name',
                'value' => function($model) {
                    return ucwords($model->maiden_name);
                }
            ],
            [
                'label' => 'Age',
                'value' => function($model){
                    $birthdate = $model->date_of_birth;
                    $currentdate = date("Y/m/d");
                    $age = date_diff(date_create($birthdate), date_create($currentdate));
                    return $age->format("%y");
                }
            ],
            'gender',
            'marital_status',
        ],
    ]) ?>

    <br/>
        <h4>Membership Details</h4>
    <?= DetailView::widget([
        'model' => $membership,
        'attributes' => [
            [
                'label' => 'Status',
                'value' => function($model) {
                    if($model->status == 1) {
                        return 'Baptised';
                    } else if($model->status == 2) {
                        return 'Not Baptised';
                    }
                }
            ],
            [
                'label' => 'Type',
                'value' => function($model) {
                    if($model->type == 1 || $model->type == 4) {
                        return 'Student';
                    } else if($model->type == 2) {
                        return 'University SDA';
                    } else if($model->type == 3) {
                        return 'Other SDA';
                    } else if($model->type == 5) {
                        return 'Sabbath School';
                    }
                }
            ],
            [
                'label' => 'Congregation',
                'value' => function($model) {
                    return ucwords($model->congregation);
                }
            ]
        ],
    ]) ?>
        <?php if(isset($address)) { ?>
        <br/>
        <h4>Address Details</h4>
        <?= DetailView::widget([
            'model' => $address,
            'attributes' => [
                [
                    'label' => 'Home Address',
                    'value' => function($model) {
                        return ucwords($model->home_address);
                    }
                ],
                'mobile_number',
                'whatsapp_number',
                'facebook_id',
                'twitter_id',
                'instagram_id',
                'primary_email',
                'secondary_email'
            ],
        ]) 
     /* echo \pigolab\locationpicker\LocationPickerWidget::widget(['key' => 'AIzaSyDv-IpBtkvXCa3xyj2umNPrbZgh_XoxoFQ' ,	// require , Put your google map api key
            //'valueTemplate' => '{latitude},{longitude}' , // Optional , this is default result format
            'options' => [
                'style' => 'width: 100%; height: 400px',  // map canvas width and height
            ] ,
            'clientOptions' => [
                'location' => [
                    'latitude'  => $latitude ,
                    'longitude' => $longitude,
                ],
            ]
        ]);?*/?>
        <?php } if(isset($work)) {?>
        <br/>
        <h4>Work Place Details</h4>
        <?= DetailView::widget([
            'model' => $work,
            'attributes' => [
                [
                    'label' => 'Name of Work Place',
                    'value' => function($model) {
                        return ucwords($model->name_of_work_place);
                    }
                ],
                [
                    'label' => 'Type of business',
                    'value' => function($model) {
                        return ucwords($model->type_of_business);
                    }
                ],
                [
                    'label' => 'Job title',
                    'value' => function($model) {
                        return ucwords($model->job_title);
                    }
                ],
                [
                    'label' => 'Address',
                    'value' => function($model) {
                        return ucwords($model->address);
                    }
                ],
                [
                    'label' => 'Salary',
                    'value' => function($model) {
                        return 'ZMW '.number_format($model->salary);
                    }
                ],
            ],
        ]) ?>
        <?php } ?>
    </div>
</div>
