<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use kartik\grid\EditableColumnAction;

use app\models\KPI;
use app\models\User;
use app\models\RoleStatus;
use app\models\Department;
use app\models\Initiative;
use app\models\StrategicTheme;
use app\models\StrategicObjective;
use app\models\AccomplishedActivity;
use app\models\AccomplishedActivitySearch;


/**
 * AccomplishedActivityController implements the CRUD actions for AccomplishedActivity model.
 */
class AccomplishedActivityController extends Controller
{
    
        public function actions(){
        return ArrayHelper::merge(parent::actions(), [
           'editReport' => [                                       // identifier for your editable column action
               'class' => EditableColumnAction::className(),     // action class name
               'modelClass' => AccomplishedActivity::className(),                // the model for the record being edited
               'outputValue' => function ($model, $attribute, $key, $index) {
                     return (int) $model->$attribute / 100;      // return any custom output value if desired
               },
               'outputMessage' => function($model, $attribute, $key, $index) {
                    
                    if($model->save()){
                        return 'Input saved';  
                    }else
                        return 'Not saved';
                // any custom error to return after model save
               },
               'showModelErrors' => true,                        // show model validation errors after save
               'errorOptions' => ['header' => '']               
           ],
       ]);
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * Lists all AccomplishedActivity models.
     * @return mixed
     */
    public function actionIndex($qt=null,$dept=null)
    {
        
        
        
        if (User::userIsAllowedTo('Manage Department')) {
            
            if ($qt == null){
                 Yii::$app->session->setFlash('error', 'Select the quarter you want.');
                return $this->render('quarter-search', [ 
                    
                ]);
            } else {
                $qt = ((intval($qt) >= 1 && intval($qt) <= 4) || intval($qt)==1234) ? intval($qt) : 1;
            }
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            
            $searchModel = new AccomplishedActivitySearch();
            if (intval($qt)==1234){
                $accomplishedActivities = AccomplishedActivity::findAll(['department' => $department->id]);
            } else {
                $accomplishedActivities = AccomplishedActivity::findAll(['department' => $department->id, 'quarter' => $qt]);
            }
            
            $initiatives = Initiative::findAll(['department_id' => $department->id, 'status' => 9]);
            $strategic_objectives = StrategicObjective::findAll(['department' => $department->id, 'status' => 9]);
            $strategic_themes = StrategicTheme::find()->asArray()->all();
            $KPIs = KPI::findAll(['department' => $department->id]);

            if(!empty($accomplishedActivities) ){
                 return $this->render('index',[ 
                    //'resource_persons' => $resource_persons,
                    //'responsible_persons' => $responsible_persons,
                     'accomplishedActivities' => $accomplishedActivities,
                    'initiatives' => $initiatives,
                    'strategic_objectives' => $strategic_objectives,
                    'KPIs' => $KPIs,
                    'department' => $department,
                    'strategic_themes' => $strategic_themes,
                    'searchModel' => $searchModel,
                    'qt' => $qt,
                    'dept' => $department->id,
    
                    //'scorecard' => array_merge($resource_persons, $responsible_persons, $initiatives, $strategic_objectives, $KPIs, $department, $strategic_themes)
                ]);
            }
            Yii::$app->session->setFlash('error', 'You have not reported anything in the selected quarter(s) yet. Click <b>Report an Activity</b> to start reporting...');
            return $this->render('quarter-search',[ 
                'value' => $qt
                ]);
        }
        if (User::userIsAllowedTo('View Plans And Reports') || User::userIsAllowedTo('Manage Plans And Reports')) {
            $session = Yii::$app->session;
            
            
            $department = Department::findOne(['id' => $dept]);
            
            if ($qt == null || $dept==null || empty($department)){
                 Yii::$app->session->setFlash('error', 'Select both the quarter and department.');
                return $this->render('quarter-search',[ 
                    
                ]);
            } else {
                $qt = ((intval($qt) >= 1 && intval($qt) <= 4) || intval($qt)==1234) ? intval($qt) : 1;
            }
            
            
            $searchModel = new AccomplishedActivitySearch();
            if (intval($qt)==1234){
                $accomplishedActivities = AccomplishedActivity::findAll(['department' => $department->id]);
            } else {
                $accomplishedActivities = AccomplishedActivity::findAll(['department' => $department->id, 'quarter' => $qt]);
            }
            
            $initiatives = Initiative::findAll(['department_id' => $department->id, 'status' => 9]);
            $strategic_objectives = StrategicObjective::findAll(['department' => $department->id, 'status' => 9]);
            $strategic_themes = StrategicTheme::find()->asArray()->all();
            $KPIs = KPI::findAll(['department' => $department->id]);

            if(!empty($accomplishedActivities) ){
                 return $this->render('index',[ 
                    //'resource_persons' => $resource_persons,
                    //'responsible_persons' => $responsible_persons,
                     'accomplishedActivities' => $accomplishedActivities,
                    'initiatives' => $initiatives,
                    'strategic_objectives' => $strategic_objectives,
                    'KPIs' => $KPIs,
                    'department' => $department,
                    'strategic_themes' => $strategic_themes,
                    'searchModel' => $searchModel,
                    'qt' => $qt,
                    'dept' => $department->id,
                    //'scorecard' => array_merge($resource_persons, $responsible_persons, $initiatives, $strategic_objectives, $KPIs, $department, $strategic_themes)
                ]);
            }
            Yii::$app->session->setFlash('error', 'Department has not reported anything in the selected quarter(s) yet.');
            return $this->render('quarter-search',[ 
                'value' => $qt,
                'dept' => $dept
                ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/']);
        
    }

    /**
     * Displays a single AccomplishedActivity model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AccomplishedActivity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AccomplishedActivity();

        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            
            if ($model->load(Yii::$app->request->post())) {
                $initiative = Initiative::findOne(['id' => $model->initiative]);
                $model->id = 0;
                $model->department = $department->id;
                $model->created_by = User::getCurrentUserID();
                $model->kpi = $initiative->kpi;
                $model->strategic_objective = $initiative->strategic_objective;
                $model->strategic_theme = $initiative->strategic_theme;
                $model->updated_by = User::getCurrentUserID();
                $model->updated_at = 0;
                $model->created_at = 0;
                $model->status = 9;
                
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Activity reported successfully.');
                    return $this->redirect(['index']);
                }
                Yii::$app->session->setFlash('error', 'Something happenned, the activity was not reported successfully.');
                
                var_dump($model->getErrors());
            }

            return $this->render('create', [
                'model' => $model,
            ]);
      } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Updates an existing AccomplishedActivity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AccomplishedActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->delete()){
            Yii::$app->session->setFlash('success', 'Activity was deleted successfully.');
            return $this->redirect(['index']);
        }
        
        Yii::$app->session->setFlash('error', 'Activity not deleted. Contact the Technical team for assistance.');
        return $this->redirect(['index']);
    }

    
    
    //Restores an existing model
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        $model->status = 9;
        
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Activity was restored successfully.');
            return $this->redirect(['index']);
        }
        Yii:$app->session->setFlash('error', 'Activity not restored. Contact the Technical team for assistance.');
        return $this->redirect(['index']);
    }
    
    
    
    /**
     * Finds the AccomplishedActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AccomplishedActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AccomplishedActivity::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
