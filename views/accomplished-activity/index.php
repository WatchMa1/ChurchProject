<?php


use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\data\ArrayDataProvider;
use kartik\mpdf\Pdf;
use kartik\grid\GridView;
use kartik\editable\Editable;
use kartik\export\ExportMenu;
use app\models\KPI;
use app\models\Department;
use app\models\User;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccomplishedActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$department = Department::findOne(['id' => $dept]);
$qt_title = ($qt == 1234) ? 'All Quarters' : 'Quarter ' . $qt;
$this->title = $department->name . ' Report: '.$qt_title;
$this->params['breadcrumbs'][] = $this->title;





?>
<div class="accomplished-activity-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
 <?php if (User::userIsAllowedTo('Manage Department')) {?>
    <p>
        <?= Html::a('Report An Activity', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php }?>

    <?php 
        echo $this->render('_select-quarter', [
            'value' => $qt
        ]);
    $dataProvider = new ArrayDataProvider([
        'allModels' => $accomplishedActivities,
        'pagination' => [
            'pageSize' => 15,
        ],
        'sort' => [
            'attributes' => ['strategic_theme'],
        ],
    ]);
    if ($qt == 1234){
        $quarterColumn = [
            'attribute' => 'quarter',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '100px',
            'noWrap' => false,
        ]; 
    } else{
        $quarterColumn=[
            'hiddenFromExport'=>true,
            'hidden' => true,
        ];
    }
    
    $gridColumns = [
        //['class' => 'kartik\grid\SerialColumn'],
        [
            // 'class' => 'kartik\grid\EditableColumn',
            //'contentOptions' => ['kartik-sheet-style'],
            'attribute' => 'strategic_theme',
            'value' => 'strategicTheme.theme',
            // 'filterType' => GridView::FILTER_COLOR,
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            //'asPopover' => false,
            'noWrap' => false,
            /*'editableOptions' => function ($model, $key, $index) {
                            
                $strategic_themes = app\models\StrategicTheme::findAll(['status' => 9]);
                $themes = [];
                $i = 0;
                foreach($strategic_themes as $theme){
                    $themes[$theme->id] = $theme->theme;
                    $i = $i + 1;       
                }
                return [
                    'header' => 'Strategic Theme',
                    'asPopover' => false,
                    'data' => $themes,
                    'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
                    // appear above the text box
                    'beforeInput' => '',
                    'formOptions' => ['action' => ['editInitiative']],
                ];
            }*/
        ],
        [
            //'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'strategic_objective',
            'value' => 'strategicObjective.objective',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            //'asPopover' => false,
            'noWrap' => false,

            /*'editableOptions' => function ($model, $key, $index) {
        $strategic_objectives = app\models\StrategicObjective::findAll(['status' => 9, 'department' => $model->department]);
        $objectives = [];
        $i = 0;
        foreach($strategic_objectives as $objective){
            $objectives[$objective->id] = $objective->objective;
            $i = $i + 1;       
        }
        return [
            'header' => 'Strategic Objective',
            'asPopover' => false,
            'inputType' => \kartik\editable\Editable::INPUT_DROPDOWN_LIST,
             'data' => $objectives,
            // appear above the text box
            'beforeInput' => '',
            'formOptions' => ['action' => ['editInitiative']],
        ];
    }*/
        ],
        [
            'attribute' => 'kpi',
            'value' => 'kpi0.measure',
            'header' => 'Measure(KPI)',
            // 'filterType' => GridView::FILTER_COLOR,
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false
        ],
        [
            'attribute' => 'initiative',
            'value' => 'initiative0.activity',
            'header' => 'Initiative',
            // 'filterType' => GridView::FILTER_COLOR,
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false
        ],

        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'color',
            'value' => function ($model, $key, $index, $widget) {
                return "<span class='badge' style='background-color: {$model->color}'> </span>  <code>" .
                    $model->color . '</code>';
            },
            'filterType' => GridView::FILTER_COLOR,
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false,
            'editableOptions' => function ($model, $key, $index) {
                return [
                    'header' => 'Color Code',
                    'size' => 'md',
                    'asPopover' => false,
                    'afterInput' => function ($form, $widget) use ($model, $index) {
                        return $form->field($model, "color")->widget(\kartik\color\ColorInput::classname(), [
                            'showDefaultPalette' => false,
                            'options' => ['id' => "color-{$index}"],
                            'pluginOptions' => [
                                'showPalette' => true,
                                'showPaletteOnly' => true,
                                'showSelectionPalette' => true,
                                'showAlpha' => false,
                                'allowEmpty' => false,
                                'preferredFormat' => 'name',
                                'palette' => [
                                    ["green", "orange", "red",],
                                ]
                            ],
                        ]);
                    },
                    'formOptions' => ['action' => ['editReport']],
                ];
            }
        ],
        [
            'attribute' => 'kpi',
            'value' => function ($model, $key) {
                if ($model->quarter == 1) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $kpi->q1_target;
                } else if ($model->quarter == 2) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $kpi->q2_target;
                } else if ($model->quarter == 3) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $kpi->q3_target;
                } else if ($model->quarter == 4) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $kpi->q4_target;
                }
            },
            'header' => 'Target',
            // 'filterType' => GridView::FILTER_COLOR,
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false
        ],
        
        $quarterColumn,
        
        [
            'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'achieved_score',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false,
            'editableOptions' => function ($model, $key, $index) {
                return [
                    'header' => 'Achieved Score',
                    'asPopover' => false,
                    'inputType' => \kartik\editable\Editable::INPUT_TEXTAREA,
                    // appear above the text box
                    'beforeInput' => '',
                    'formOptions' => ['action' => ['editReport']],
                ];
            }
        ],
        [
            //'attribute' => 'achieved_score',
            'header' => 'Percentage',
            'value' => function ($model, $key, $index, $widget) {
                if ($model->quarter == 1 && $kpi->q1_target != 0) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $model->achieved_score / $kpi->q1_target * 100 . '%';
                } else if ($model->quarter == 2 && $kpi->q2_target != 0) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $model->achieved_score / $kpi->q2_target * 100 . '%';
                } else if ($model->quarter == 3 && $kpi->q3_target != 0) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $model->achieved_score / $kpi->q3_target * 100 . '%';
                } else if ($model->quarter == 4 && $kpi->q4_target != 0) {
                    $kpi = KPI::findOne(['id' => $model->kpi]);
                    return $model->achieved_score / $kpi->q4_target * 100 . '%';
                }
            },
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '150px',
            'noWrap' => false,
        ],
        [
            //'class' => 'kartik\grid\EditableColumn',
            'attribute' => 'reason_for_disparity',
            'vAlign' => 'middle',
            'format' => 'raw',
            'width' => '100px',
            'noWrap' => false,
        ],
        [
            'class' => 'kartik\grid\ActionColumn', 'header' => 'Action', 'headerOptions' => ['style' => 'width:150px', 'class'=> 'skip-export'],
            'buttons'  => [
                
                'update' => function ($url, $model) {
                    
                        return Html::a('<span class="fa fa-pencil-alt btn btn-sm btn-primary"></span>', ['accomplished-activity/update', 'id' => $model->id],
                            ['title' => 'Update']);
                    
                },
                'delete' => function ($url, $model) {
                    
                        return Html::a('<span class="fa fa-trash  btn btn-sm btn-danger"></span>', Url::to(['accomplished-activity/delete', 'id' => $model->id]), [
                            'title' => 'Delete',
                            'data'=> [
                                'confirm' => Yii::t('yii', 'Are you sure you want to delete this entry?'),
                                'method' => 'post',
                            ]
                        ]);
                    
                }, 
            ],
            'template' => '{update} {delete}',

        ],
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
            'filename' => $this->title,
            'alertMsg' => Yii::t('kvgrid', 'The HTML export file will be generated for download.'),
            'options' => ['title' => $this->title],
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
            'filename' => $this->title,
            'alertMsg' => Yii::t('kvgrid', 'The CSV export file will be generated for download.'),
            'options' => ['title' => $this->title],
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
            'filename' => $this->title,
            'alertMsg' => Yii::t('kvgrid', 'The TEXT export file will be generated for download.'),
            'options' => ['title' => $this->title],
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
            'filename' => $this->title,
            'alertMsg' => Yii::t('kvgrid', 'The EXCEL export file will be generated for download.'),
            'options' => ['title' => $this->title],
            'mime' => 'application/vnd.ms-excel',
            'config' => [
                'worksheet' => Yii::t('kvgrid', 'Report'),
                'cssFile' => ''
            ]
        ],
        ExportMenu::PDF => [
            'label' => Yii::t('kvgrid', 'PDF'),
            'showHeader' => true,
            'filename' => $this->title,
            'config' => [

                'mode' => 'c',
                'format' => 'A4-L',
                'destination' => 'D',
                'marginTop' => 20,
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
                        'University SDA Church - Report'
                    ],
                    'SetFooter' => [
                        'University SDA Church - ' . strftime("%c") . '||Page {PAGENO}'
                    ],
                ],
                'options' => [
                    'filename' => $this->title,
                    'subject' => Yii::t('kvgrid', 'Generate PDF scorecard export?'),
                    'keywords' => Yii::t('kvgrid', 'Report')
                ],
                'contentBefore' => Yii::t('kvgrid', ' ' . $department->name . ' '.$qt_title. ' Report'),
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

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'summary' => false,
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
            [
                'columns' => [
                    ['content' => '',  'options' => ['colspan' => 5,      'class' => 'text-center warning']],
                    ['content' => '',      'options' =>   ['colspan' => 1,    'class' => 'text-center warning']],
                    ['content' => 'Performance on Target', 'options' =>      ['colspan' => 3, 'class' => 'text-center warning']],
                ],
                'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],
        'toolbar' =>  [
            '{export}'
        ],
        'pjax' => false,
        'bordered' => true,
        'striped' => true,
        'condensed' => false,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        //'floatHeaderOptions' => ['top' => $scrollingTop],
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
        'exportConfig' => $defaultExportConfig
    ]);
    ?>
</div>