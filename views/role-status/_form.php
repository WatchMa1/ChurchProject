<?php
use kartik\depdrop\DepDrop;
use yii\helpers\Url;
use app\models\Role;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;


/* @var $this yii\web\View */
/* @var $model app\models\RoleStatus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="card shadow">

    <?php $form = ActiveForm::begin(); ?>
<div class="card-header">
        <h4>Leadership History</h4>
    </div>
    <div class="card-body">
     <div class="form-group field-user-department">
          
            <?= $form->field($model, 'department')->dropDownList(\yii\helpers\ArrayHelper::map(Department::find()->asArray()->all(),
                'id', 'name'), ['prompt' => 'Select Department'])->label(false) ?>
        </div>
        <div class="form-group field-user-role">
           
            <?= $form->field($model, 'role')->dropDownList(\yii\helpers\ArrayHelper::map(Role::find()->asArray()->all(),
                'id', 'name'), ['prompt' => 'Select Role'])->label(false) ?>
                
        </div>
    <div>
                <?php echo $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                'yearStart' => 0,
                'yearEnd' => -20,
                ])->label(false);
                ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
        </div>
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
</div>