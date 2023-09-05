<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $searchModel app\models\KPISearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use app\models\Department;

$session = Yii::$app->session;
$department = $session['department'];
$department = Department::findOne(['id' => $department]);
$this->title = $department->name . ' Score Card';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>

    <div class="dropdown dropright mb-3">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Edit Scorecard
        </a>

        <div class="dropdown-menu ">
            <?= Html::a('Strategic Objectives', ['strategic-objective/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('KPIs', ['k-p-i/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>
            <?= Html::a('Initiatives', ['initiative/index'], ['class' => 'dropdown-item font-weight-bold text-primary']) ?>

        </div>
    </div>

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
            'value' => function ($model) {
                return $model->id;
            },
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
    $defaultExportConfig = [

        GridView::HTML => [
            'label' => Yii::t('kvgrid', 'HTML'),
            //'icon' => $isFa ? 'file-text' : 'floppy-saved',
            'iconOptions' => ['class' => 'text-info'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => Yii::t('kvgrid', $department->name . ' - Scorecard'),
            'alertMsg' => Yii::t('kvgrid', 'The HTML export file will be generated for download.'),
            'options' => ['title' => Yii::t('kvgrid', $department->name . ' - Scorecard')],
            'mime' => 'text/html',
            'config' => [
                'cssFile' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'
            ]
        ],
        GridView::CSV => [
            'label' => Yii::t('kvgrid', 'CSV'),
            //'icon' => $isFa ? 'file-code-o' : 'floppy-open', 
            'iconOptions' => ['class' => 'text-primary'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => Yii::t('kvgrid', $department->name . ' - Scorecard'),
            'alertMsg' => Yii::t('kvgrid', 'The CSV export file will be generated for download.'),
            'options' => ['title' => Yii::t('kvgrid', 'Comma Separated Values')],
            'mime' => 'application/csv',
            'config' => [
                'colDelimiter' => ",",
                'rowDelimiter' => "\r\n",
            ]
        ],
        GridView::TEXT => [
            'label' => Yii::t('kvgrid', 'Text'),
            //'icon' => $isFa ? 'file-text-o' : 'floppy-save',
            'iconOptions' => ['class' => 'text-muted'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => Yii::t('kvgrid', $department->name . ' - Scorecard'),
            'alertMsg' => Yii::t('kvgrid', 'The TEXT export file will be generated for download.'),
            'options' => ['title' => Yii::t('kvgrid', 'Tab Delimited Text')],
            'mime' => 'text/plain',
            'config' => [
                'colDelimiter' => "\t",
                'rowDelimiter' => "\r\n",
            ]
        ],
        GridView::EXCEL => [
            'label' => Yii::t('kvgrid', 'Excel'),
            //'icon' => $isFa ? 'file-excel-o' : 'floppy-remove',
            'iconOptions' => ['class' => 'text-success'],
            'showHeader' => true,
            'showPageSummary' => true,
            'showFooter' => true,
            'showCaption' => true,
            'filename' => Yii::t('kvgrid', $department->name . ' - Scorecard'),
            'alertMsg' => Yii::t('kvgrid', 'The EXCEL export file will be generated for download.'),
            'options' => ['title' => Yii::t('kvgrid', 'Microsoft Excel 95+')],
            'mime' => 'application/vnd.ms-excel',
            'config' => [
                'worksheet' => Yii::t('kvgrid', 'Scorecard'),
                'cssFile' => ''
            ]
        ],
        ExportMenu::PDF => [
            'label' => Yii::t('kvgrid', 'PDF'),
            'showHeader' => true,
            'filename' => Yii::t('kvgrid', $department->name . ' - Scorecard'),
            'config' => [

                'mode' => 'c',
                'format' => 'A4-L',
                'destination' => 'D',
                'marginTop' => 15,
                'marginBottom' => 20,
                'cssInline' => '.kv-wrap{padding:20px;}' .
                    '.kv-align-center{text-align:center;}' .
                    '.kv-align-center{text-align:center;}' .
                    '.kv-align-left{text-align:left;}' .
                    '.kv-align-top{vertical-align:top!important;}' .
                    '.kv-align-bottom{vertical-align:bottom!important;}' .
                    '.kv-align-middle{vertical-align:middle!important;}' .
                    '.kv-page-summary{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-footer{border-top:4px double #ddd;font-weight: bold;}' .
                    '.kv-table-caption{font-size:1.5em;padding:8px;border:1px solid #ddd;border-bottom:none;}',
                'methods' => [
                    'SetHeader' => [
                        'University SDA Church - ' . $department->name . ' Scorecard'
                    ],
                    'SetFooter' => [
                        'University SDA Church - ' . strftime("%c") . '||Page {PAGENO}'
                    ],
                ],
                'options' => [
                    'filename' => Yii::t('kvgrid', ' ' . $department->name . ' Scorecard'),
                    'subject' => Yii::t('kvgrid', 'Generate PDF scorecard export?'),
                    'keywords' => Yii::t('kvgrid', 'Scorecard')
                ],
                'contentBefore' => Yii::t('kvgrid', ' ' . $department->name . ' Scorecard'),
                'contentAfter' => ''

            ],

        ],
        /*GridView::JSON => [
						'label' => Yii::t('kvgrid', 'JSON'),
						'icon' => $isFa ? 'file-code-o' : 'floppy-open',
						'iconOptions' => ['class' => 'text-warning'],
						'showHeader' => true,
						'showPageSummary' => true,
						'showFooter' => true,
						'showCaption' => true,
						'filename' => Yii::t('kvgrid', 'grid-export'),
						'alertMsg' => Yii::t('kvgrid', 'The JSON export file will be generated for download.'),
						'options' => ['title' => Yii::t('kvgrid', 'JavaScript Object Notation')],
						'mime' => 'application/json',
						'config' => [
							'colHeads' => [],
							'slugColHeads' => false,
							'jsonReplacer' => null,
							'indentSpace' => 4
						]
					],*/
    ];

    $pdfHeader = [
        'L' => [
            'content' => 'LEFT CONTENT (HEAD)',
        ],
        'C' => [
            'content' => 'CENTER CONTENT (HEAD)',
            'font-size' => 10,
            'font-style' => 'B',
            'font-family' => 'arial',
            'color' => '#333333'
        ],
        'R' => [
            'content' => 'RIGHT CONTENT (HEAD)',
        ],
        'line' => true,
    ];

    $pdfFooter = [
        'L' => [
            'content' => 'LEFT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'C' => [
            'content' => 'CENTER CONTENT (FOOTER)',
        ],
        'R' => [
            'content' => 'RIGHT CONTENT (FOOTER)',
            'font-size' => 10,
            'color' => '#333333',
            'font-family' => 'arial',
        ],
        'line' => true,
    ];

    echo Gridview::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,

        //'containerOptions' => ['style'=>'overflow: auto'],
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '', 'options' => ['colspan' => 2,]],
                    ['content' => 'KPI(Measures)', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
                    ['content' => 'Initiatives', 'options' => ['colspan' => 6, 'class' => 'text-center warning']],
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
        'exportConfig' => $defaultExportConfig

    ]);

    ?>




</div>