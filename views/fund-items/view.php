<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Department;
/* @var $this yii\web\View */
/* @var $model app\models\FundItems */

$this->title = $model->item_name;
$this->params['breadcrumbs'][] = ['label' => 'Finance','url' => ['/finance-and-reports/index']];
$this->params['breadcrumbs'][] = ['label' => 'Fund Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fund-items-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'item_name',
            [
                'attribute' => 'budget',
                'value' => function ($model) {
                    return 'K '.number_format($model->budget,2);
                }
            ],
            [
                'attribute' => 'fund_category',
                'value' => function ($model) {
                    $category = $model->fund_category;
                    switch ($category) {
                        case '20':
                            $category_name = 'LOCAL FUNDS';
                            break;
                        case '21':
                            $category_name = 'LOCAL TRUST FUNDS ';
                            break;
                        case '23':
                            $category_name = 'TRUST FUNDS';
                            break;
                        default:
                            $category_name = 'LOCAL FUNDS';
                            break;
                    }
                    return $category_name;
                
                }
            ],
            [
                'attribute' => 'Department',
                'value' => function ($model) {
                    $dept = $model->dept;
                    if (strlen($dept) > 0 ){
                        if (($depModel = Department::findOne(['id' => $dept])) !== null){
                            $depname = $depModel->name;
                            return $depname;
                        }
                    } 
                        return '--none--';
                    
                
                }
            ],
            'year',
            'description:ntext',
            'created_at:date',
            'updated_at:date',
        ],
    ]) ?>

</div>