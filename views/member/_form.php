<?php

use kartik\date\DatePicker;
use kartik\depdrop\DepDrop;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Member */
/* @var $membership app\models\MembershipStatus */
/* @var $address app\models\Address */
/* @var $work app\models\WorkPlace */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="card shadow">
    <div class="card-header">
        <h4>Member Details</h4>
    </div>
    <div class="card-body">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'tag' => false,
            ],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <div class="form-group field-member-title">
                <label>Title<span class="required">*</span></label>
                <?= $form->field($model, 'title')->dropDownList(['Prof.' => 'Prof.', 'Assoc. Prof.' =>
                    'Assoc. Prof.', 'Dr.' => 'Dr.', 'Rev.' => 'Rev.', 'Fr.' => 'Fr.', 'Sr.' => 'Sr.', 'Mrs.' => 'Mrs.',
                    'Mr.' => 'Mr.', 'Ms.' => 'Ms.'], ['prompt'=>'Please select a title'])->label(false) ?>
            </div>
            <div class="form-group field-member-first_name">
                <label>First Name<span class="required">*</span></label>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                    'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter first name'])->label(false) ?>
            </div>
            <div class="form-group field-member-other_name">
                <label>Other Name(s)</label>
                <?= $form->field($model, 'other_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                    'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter other name(s)'])->label(false) ?>
            </div>
            <div class="form-group field-member-last_name">
                <label>Last Name<span class="required">*</span></label>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                    'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter last name'])->label(false) ?>
            </div>
            <div class="form-group field-member-maiden_name">
                <label>Maiden Name</label>
                <?= $form->field($model, 'maiden_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                    'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter maiden name'])->label(false) ?>
            </div>
            <div class="form-group field-member-gender">
                <label>Gender<span class="required">*</span></label>
                <?= $form->field($model, 'gender')->dropDownList(['Female' => 'Female', 'Male' => 'Male'],
                    ['prompt' => 'Select the gender'])->label(false) ?>
            </div>
        </div>
        <div class="col-md-4 col-xs-12">
            <div class="form-group field-member-date_of_birth">
                <label class="control-label">Date of birth<span class="required">*</span></label>
                <?= $form->field($model, 'date_of_birth')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => 'Select date of birth ...'],
                    'type' => DatePicker::TYPE_INLINE,
                    'pluginOptions' => [
                        'autoclose' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ])->label(false) ?>
            </div>
            <div class="form-group field-member-marital_status">
                <label>Marital Status<span class="required">*</span></label>
                <?= $form->field($model, 'marital_status')->dropDownList(['Single' => 'Single', 'Divorced' =>
                    'Divorced', 'Widowed' => 'Widowed', 'Married' => 'Married'],
                    ['prompt' => 'Select the marital status'])->label(false) ?>
            </div>
        </div>
    </div>
</div>
</div>
<br/>
<div class="card shadow">
    <div class="card-header">
        <h4>Membership Details</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-xs-12">
        <div class="form-group field-membershipstatus-status">
            <label class="control-label">Membership Status<span class="required">*</span></label>
            <?= $form->field($membership, 'status')->dropDownList(['1' => 'Baptised', '2' => 'Not Baptised'],
                ['prompt' => 'Select a member type', 'class' => 'form-control', 'id' => 'status'])->label(false) ?>
        </div>
        <div class="form-group field-membership_status-type">
            <label class="control-label">Membership Type<span ></span></label>
            <?= $form->field($membership, 'type')->widget(DepDrop::classname(), [
                'class' => 'form-control',
                'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                'pluginOptions'=>[
                    'depends'=>['status'],
                    'placeholder'=>'Select a type',
                    'url'=>Url::to(['/member/status'])
                ]
            ])->label(false) ?>
        </div>
            </div>
            <div class="col-md-6 col-xs-12">
        <div class="form-group field-membershipstatus-congregation">
            <label class="control-label">Congregation</label>
            <?= $form->field($membership, 'congregation')->textInput(['class' => 'form-control', 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Optional'])->label(false) ?>
        </div>
            </div>
        </div>
    </div>
</div>
<br/>
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
<br/>
<div class="card shadow">
    <div class="card-header">
        <h4>Workplace Details</h4><p>(Populate if applicable.)</p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="form-group field-workplace-name_of_work_place">
                    <label>Name of Work place</label>
                    <?= $form->field($work, 'name_of_work_place')->textarea(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter name of work place'])->label(false) ?>
                </div>
                <div class="form-group field-workplace-type_of_business">
                    <label>Type of business</label>
                    <?= $form->field($work, 'type_of_business')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter type of business'])->label(false) ?>
                </div>
                <div class="form-group field-workplace-job_title">
                    <label>Job title</label>
                    <?= $form->field($work, 'job_title')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter job title'])->label(false) ?>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group field-workplace-address">
                    <label>Address</label>
                    <?= $form->field($work, 'address')->textarea(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter address'])->label(false) ?>
                </div>
                <div class="form-group field-workplace-salary">
                    <label>Salary</label>
                    <?= $form->field($work, 'salary')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                        'autocapitalize' => 'none', 'autocomplete' => 'off', 'placeholder' => 'Enter salary'])->label(false) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>