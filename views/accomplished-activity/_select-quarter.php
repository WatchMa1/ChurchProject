<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Department;
use app\models\User;
/* @var $this yii\web\View */
/* @var $model app\models\AccomplishedActivitySearch */
/* @var $form yii\widgets\ActiveForm */



?>

<div class="accomplished-activity-search border-bottom border-1">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row mb-3">
 
        <div class="col-6 mb-3">
            <select id=""  class="form-control" name="qt">
    
                <option <?=($value ==1) ? 'selected' : ''?> value="1">FIRST QUARTER</option>
            
                <option <?=($value ==2) ? 'selected' : ''?> value="2">SECOND QUARTER</option>
            
                <option <?=($value ==3) ? 'selected' : ''?> value="3">THIRD QUARTER</option>
            
                <option <?=($value ==4) ? 'selected' : ''?> value="4">FOURTH QUARTER</option>
            
                <option <?=($value ==1234) ? 'selected' : ''?> value="1234">ALL QUARTERS</option>
            
            </select>
        </div>
        <?php if (User::userIsAllowedTo('View Plans And Reports') || User::userIsAllowedTo('Manage Plans And Reports')) {?>
        <div class="col-6 mb-3">
            <select id=""  class="form-control" name="dept">
                <?php 
                $departments = Department::find()->asArray()->all();
                foreach ($departments as $dep) {
                    $dep_id = $dep['id'];
                    $dep_name = $dep['name'];
                ?>
                    <option <?php if($dept == $dep_id) { echo  'selected'; }?> value="<?=$dep_id?>"><?=$dep_name?></option>
                <?php
                }
                
                ?>
                


            </select>
        </div>
        
        <?php
            }
                
        ?>
    
        <div class="col-6 ">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary w-100']) ?>
        </div>
   </div>
    <?php ActiveForm::end(); ?>

</div>
