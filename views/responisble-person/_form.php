<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Initiative;
use app\models\Department;
use app\models\DepartmentMember;
use app\models\Member;

$session = Yii::$app->session;
$members = DepartmentMember::findAll(['department' => $session['department']]);
$depmembers = [];
$total = 0;
foreach($members as $member) {
    $depmembers[$total] = Member::findOne($member);
    $total += 1; 
}

/* @var $this yii\web\View */
/* @var $model app\models\ResponsiblePerson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="responsible-person-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="card shadow">
        <div class="card-body">
            <?= $form->field($model, 'initiative')->dropDownList(\yii\helpers\ArrayHelper::map(Initiative::find()->asArray()->all(),
                'id', 'activity'), ['prompt' => 'Initiative'])->label(false) ?>
            <?= $form->field($model, 'department_member')->dropDownList(\yii\helpers\ArrayHelper::map($depmembers,'id', 'first_name', 'last_name'),
                 ['prompt' => 'Responsible Person'])->label(false); ?>

        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
