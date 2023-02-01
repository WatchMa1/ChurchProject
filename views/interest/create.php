<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Interest */
if(Yii::$app->user->isGuest){
	$this->params['help'] = 'Please fill your personal details in the form below and click <button class="btn btn-sm btn-primary">save</button> to submit them.';
	$this->title = 'Welcome dear Visitor';
	
}else {
	$this->params['help'] = 'Please fill the visitors details in the form below and click <button class="btn btn-sm btn-primary">save</button> to submit them.';
	$this->title = 'Create Interest';
	$this->params['breadcrumbs'][] = ['label' => 'Interests', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="interest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
