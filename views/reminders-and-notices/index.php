<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RemindersAndNoticesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reminders And Notices';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reminders-and-notices-index">

    <h1><?= Html::encode($this->title) ?></h1>
<?php 
    if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
?>
    <p class="d-flex justify-content-end">
        <?= Html::a('Add <i class="fas fa-plus"></i>', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php
}?>


    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            $title = Html::encode($model->title);
            $html = '<div class="border-top pt-2 my-2">';
            $html = $html. '<span class="font-weight-bold">'.Html::a($title, ['view', 'id' => $model->id]).'</span>';
            $html = $html. '<br> <em>'.date('D - jS M, Y',$model->date_of_notice).'</em>';
            $html = $html.'</div>';
            return $html;
        },
    ]) ?>

    <?php Pjax::end(); ?>

</div>
