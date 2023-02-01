<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Family */

$this->title = 'Family Details';
$this->params['breadcrumbs'][] = $this->title;
$this->params['help'] = '<ul><li>Click <button class="btn btn-sm btn-primary">Update</button> to edit the Family Details.</li></ul>';
\yii\web\YiiAsset::register($this);
$attributes = [['attribute' => 'family_name', 'value' => function($model){return ucwords($model->family_name);}],
    ['attribute' => 'prayer_band', 'value' => function($model){return ucwords($model->prayer_band);}], ['label' =>
        'Family Photo', 'value' => function($model) {
    return Html::img('@web/uploads/family_photo/'.$model->family_photo, ['height'=>'600']);}, 'format' => 'raw']];
if(isset(Yii::$app->session['member'])) {
    $attributes = [['attribute' => 'family_name', 'value' => function($model){return ucwords($model->family_name);}],
        ['attribute' => 'prayer_band', 'value' => function($model){return ucwords($model->prayer_band);}], ['label' =>
            'Family Photo', 'value' => function($model) {
            return Html::img('@web/uploads/family_photo/'.$model->family_photo, ['height'=>'600']);}, 'format' => 'raw'],
        ['attribute' => 'head_of_family', 'format' => 'raw', 'value' => function($model){return Html::a(
                ucwords(\app\models\Member::findOne(['id' => $model->head_of_family])->getFullName()),
            ['member/view', 'id' => $model->head_of_family]);}]];
    if(isset(\app\models\Family::findOne(['id' => Yii::$app->session['family']])->spouse)) {
        array_push($attributes, ['attribute' => 'spouse', 'format' => 'raw', 'value' => function($model){return Html::a(
            ucwords(\app\models\Member::findOne(['id' => $model->spouse])->getFullName()),
            ['member/view', 'id' => $model->spouse]);}]);
    }
}
?>
<div class="card shadow">
    <div class="card-header">
        <?= Html::a('Update', ['update'], ['class' => 'btn btn-primary']) ?>
    </div>
    <div class="card-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => $attributes,
    ]) ?>
    </div>
</div>
