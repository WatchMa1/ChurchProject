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
        <div class="col-md-6 col-xs-12">
            <div class="form-group field-user-first_name">
                <label>First Name<span class="required">*</span></label>
                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>
            </div>

            <div class="form-group field-user-last_name">
                <label>Last Name<span class="required">*</span></label>
                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>
            </div>
            <div class="form-group field-user-email">
                <label>Email Address<span class="required">*</span></label>
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'autocorrect' => 'off',
                'autocapitalize' => 'none', 'autocomplete' => 'off'])->label(false) ?>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">

            <label>Role<span class="required">*</span></label>
            <?= $form->field($rolestatus, 'role')->dropDownList(\yii\helpers\ArrayHelper::map(Role::find()->asArray()->all(),
                'id', 'name'), //['onchange' => '$.post( "user/departments?role='.'"+$(this).val(), function(data){ $( "select#models.role ).html( data )})'],
                                                                ['id' => 'role'])->label(false) ?>

            <?= $form->field($rolestatus, 'department')->widget(DepDrop::classname(), [
		'type' => DepDrop::TYPE_SELECT2,
    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
    'pluginOptions' => [
        'depends' => ['role'],
        'initialize' => $model->isNewRecord ? false : true,
        'url' => Url::to(['/user/departments']),
        //'params' => ['input-type-1', 'input-type-2']
    ]
]) ?>
            <div>
                <label>Year<span class="required">*</span></label>
                <?php echo $form->field($rolestatus, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                'yearStart' => 0,
                'yearEnd' => -10,
                ])->label(false);
                ?>
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