<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use floor12\summernote\Summernote;
use app\models\User;
use app\models\Department;
/* @var $this yii\web\View */
/* @var $model app\models\RemindersAndNotices */
/* @var $form yii\widgets\ActiveForm */
if (User::userIsAllowedTo('Manage Users')) {
    $items_arr = Department::find()->asArray()->all();
} else {
    $dept = Yii::$app->session['department'];
    $items_arr = Department::find()->where(['id'=>$dept])->asArray()->all();
    $department = Department::findOne($dept);
    
}
$model->date_of_notice = date('Y-m-d\TH:i',$model->date_of_notice);

?>

<div class="reminders-and-notices-form">

    <?php $form = ActiveForm::begin(); ?>

<div class="mb-3">
    <?= $form->field($model, 'title',[ 'options' => ['style' => 'width: 100%']])->textInput() ?>
</div>

<?= $form->field($model, 'body',['options' => ['style' => 'width: 100%']])->widget(Summernote::class); ?>

<?php
if (User::userIsAllowedTo('Manage Users')) {

?>
<div class="my-3">
    <?= $form->field($model,'send_to')->dropDownList(array('all'=>'ALL','department'=>'Departmental Members'));?>
</div>

<label class="font-weight-bold">Department <small>(Only Applies if this notice is set on <u>send to: Depatmental Members</u>)</small></label>
<?= $form->field($model, 'audience',[ 'options' => ['style' => 'width: 100%']])->dropDownList(\yii\helpers\ArrayHelper::map($items_arr,
                'id', 'name'), ['id' => 'name'])->label(false) ?>
<?php
} else {
?>
<label class="font-weight-bold">This notice shall be sent to <u> <?= $department->name;?> Depatmental Members </u></label>


<?php
}
?>
<div class="my-2">
    <?= $form->field($model, 'date_of_notice')->textInput(['type'=>'datetime-local']) ?>
</div>

<?php
if (User::userIsAllowedTo('Manage Users')) {

?>
<div class="mb-2">
    <?= $form->field($model,'status')->dropDownList(array('1'=>'Published','0'=>'Not Published'));?>
</div>
<?php 
}
?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'px-5 btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
