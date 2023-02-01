<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Role;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\JsExpression;
use app\models\Department;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $rolestatus app\models\RoleStatus */
/* @var $form yii\widgets\ActiveForm */

$departments = Department::findAll(['status' => 9]);
$out = [];
$i = 0;
foreach($departments as $department){
    $out[0] = $department->name;
    $i += 1;
}
?>

<div class="card-body">

    <?php $form = ActiveForm::begin([
        'fieldConfig' => [
            'options' => [
                'tag' => false,
            ],
        ],
    ]); ?>
    <div class="row">
        <div class="col-md-12 col-xs-8">
            <div class="form-group field-user-first_name">
                <label>First Name<span class="required">*</span></label>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>

                <label>Last Name<span class="required">*</span></label>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>

                <label>Email Address<span class="required">*</span></label>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>

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