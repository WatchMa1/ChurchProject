<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
/* @var $searchModel app\models\KPISearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $department->name . ' Department Score Card';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
     <h1><?= Html::encode($this->title) ?></h1>
   <p><?= Html::a('Edit Scorecard', ['strategic-objective/'], ['class' => 'btn btn-success']) ?></p>
        
            <?php 
             $dataProvider = new ArrayDataProvider([
                                    'allModels' => $initiatives,
                                    'pagination' => [
                                        'pageSize' => 10,
                                    ],
                                    'sort' => [
                                        'attributes' => ['strategic_theme'],
                                    ],
                                ]);
                            
                $gridColumns = [
                    //['class' => 'kartik\grid\SerialColumn'],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        //'contentOptions' => ['kartik-sheet-style'],
                        'attribute' => 'strategic_theme',
                        'value' => 'strategicTheme.theme',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'strategic_objectives',
                        'value' => 'strategicObjectives.objective',
                        'pageSummary' => 'Page Total',
                        'vAlign' => 'middle',
                        'headerOptions' => ['class' => 'kv-sticky-column'],
                        'contentOptions' => ['class' => 'kv-sticky-column'],
                        //'editableOptions' => ['header' => 'Strategic Objective', 'size' => 'md']
                    ],
                    [
                        'attribute' => 'kpi',
                        'value' => 'kpi0.measure',
                        'header' => 'Measure',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'kpi',
                        'value' => 'kpi0.yearly_target',
                        'header' => 'Yearly Target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                       // 'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'kpi',
                        'value' => 'kpi0.q1_target',
                        'header' => 'Q1 Target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'kpi',
                        'value' => 'kpi0.q2_target',
                        'header' => 'Q2 Target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                       // 'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'kpi',
                        'value' => 'kpi0.q3_target',
                        'header' => 'Q3 Target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'kpi',
                        'value' => 'kpi0.q4_target',
                        'header' => 'Q4 Target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                       // 'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'activity',
                        //'value' => 'kpi0.q1_target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'start_date',
                        //'value' => 'kpi0.q1_target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'end_date',
                        //'value' => 'kpi0.q1_target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'budget',
                        //'value' => 'kpi0.q1_target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'comments',
                        //'value' => 'kpi0.q1_target',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    [
                        //'class' => 'kartik\grid\EditableColumn',
                        'attribute' => 'responsible_person',
                       'value' => 'responsible.fullName',
                       // 'filterType' => GridView::FILTER_COLOR,
                        'vAlign' => 'middle',
                        'format' => 'raw', 
                        'width' => '150px', 
                        'noWrap' => false,
                        //'editableOptions' => ['header' => 'Yearly Target', ],
                    ],
                    
                    /*[
                        'class' => 'kartik\grid\ActionColumn',
                        'dropdown' => true,
                        'vAlign' => 'middle',
                        'urlCreator' => function($action, $model, $key, $index){ return '#';},
                        'viewOptions' => ['title' => 'Title', 'data-toggle' => 'tooltip'],
                        'updateOptions' => ['title' =>'Update', 'data-toggle' => 'tooltip'],
                        'deleteOptions' => ['title' => 'Delete', 'data-toggle' => 'tooltip'],
                    ],*/
                    //['class' => 'kartik\grid\CheckboxColumn']
                ];
            
                echo Gridview::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns, 
                    //'containerOptions' => ['style'=>'overflow: auto'],
                    'beforeHeader' => [
                        [
                            'columns' => [
                                ['content' => '', 'options'=>['colspan'=>2, ]],
                                ['content' => 'KPI(Measures)', 'options'=>['colspan'=>6, 'class' => 'text-center warning']],
                                ['content' => 'Initiatives', 'options'=>['colspan'=>6, 'class' => 'text-center warning']],
                            ],
                            'options' => ['class' => 'skip-export']
                        ]
                    ],
                    'toolbar' => [
                        '{export}', 
                        '{toggleData}'
                    ],
                    'pjax' => true,
                    'bordered' => true,
                    'striped' => true, 
                    'condensed' => false,
                    'responsive' => true,
                    'hover' => true,
                    'floatHeader' => false,
                    //'floatHeaderOptions' => ['top' => $scrollingTop],
                    'showPageSummary' => true, 
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY
                    ],
                ]);
            
            ?>
                        
            
       
   
</div>