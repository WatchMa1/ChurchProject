<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Minister */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="minister-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <label>First Name</label>
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label(false) ?>
        <label>Other Name</label>
        <?= $form->field($model, 'other_name')->textInput(['maxlength' => true])->label(false) ?>
        <label>Last Name</label>
        <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label(false) ?>
    </div>
    <div class="card shadow">
    <div class="card-header">
        <h4>Address</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group field-address-home_address">
                    <label>Home Address<span class="required">*</span></label>
                    <?= $form->field($address, 'home_address')->textarea(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter home address'])->label(false) ?>
                </div>
                <div class="form-group field-address-mobile_number">
                    <label>Mobile Number<span class="required">*</span></label>
                    <?= $form->field($address, 'mobile_number')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter mobile number'])->label(false) ?>
                </div>
                <div class="form-group field-address-whatsapp_number">
                    <label><i class="fab fa-whatsapp"></i> WhatsApp Number</label>
                    <?= $form->field($address, 'whatsapp_number')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter whatsapp number'])->label(false) ?>
                </div>
                <div class="form-group field-address-facebook_id">
                    <label><i class="fab fa-facebook-square"></i> Facebook Username</label>
                    <?= $form->field($address, 'facebook_id')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter facebook username'])->label(false) ?>
                </div>
                <div class="form-group field-address-twitter_id">
                    <label><i class="fab fa-twitter"></i> Twitter Handle</label>
                    <?= $form->field($address, 'twitter_id')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter twitter handle'])->label(false) ?>
                </div>
                <div class="form-group field-address-instagram_id">
                    <label><i class="fab fa-instagram"></i> Instagram Username</label>
                    <?= $form->field($address, 'instagram_id')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter instagram username'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group field-address-primary_email">
                    <label><i class="far fa-envelope"></i> Primary Email Address<span class="required">*</span></label>
                    <?= $form->field($address, 'primary_email')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter primary email address'])->label(false) ?>
                </div>
                <div class="form-group field-address-secondary_email">
                    <label><i class="far fa-envelope"></i> Secondary Email Address</label>
                    <?= $form->field($address, 'secondary_email')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter secondary email address'])->label(false) ?>
                </div>
                <div class="form-group field-address-gps_home_location">
                    <label><i class="fas fa-map-marker-alt"></i> Home Location</label>
                    <?= $form->field($address, 'gps_home_location')->widget('\pigolab\locationpicker\CoordinatesPicker' , [
                        'key' => 'AIzaSyDv-IpBtkvXCa3xyj2umNPrbZgh_XoxoFQ' ,	// require , Put your google map api key
                        'valueTemplate' => '{latitude},{longitude}' , // Optional , this is default result format
                        'options' => [
                            'style' => 'width: 100%; height: 400px',  // map canvas width and height
                        ] ,
                        'enableSearchBox' => true , // Optional , default is true
                        'searchBoxOptions' => [ // searchBox html attributes
                            'style' => 'width: 300px;', // Optional , default width and height defined in css coordinates-picker.css
                        ],
                        'searchBoxPosition' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'), // optional , default is TOP_LEFT
                        'mapOptions' => [
                            // google map options
                            // visit https://developers.google.com/maps/documentation/javascript/controls for other options
                            'mapTypeControl' => true, // Enable Map Type Control
                            'mapTypeControlOptions' => [
                                'style'    => new JsExpression('google.maps.MapTypeControlStyle.HORIZONTAL_BAR'),
                                'position' => new JsExpression('google.maps.ControlPosition.TOP_LEFT'),
                            ],
                            'streetViewControl' => false, // Enable Street View Control
                        ],
                        'clientOptions' => [
                            // jquery-location-picker options
                            'radius' => 300,
                            'addressFormat' => 'street_number',
                            'location' => [
                                'latitude'  => -15.406257,
                                'longitude' => 28.293390,
                            ],
                        ]
                    ])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
