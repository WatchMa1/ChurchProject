<?php

namespace app\controllers;

use Yii;
use app\models\StrategicObjective;
use app\models\KPI;
use app\models\User;
use app\models\Member;
use app\models\Department;
use app\models\DepartmentMember;
use app\models\ResponsiblePerson;
use app\models\Initiative;
use app\models\InitiativeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InitiativeController implements the CRUD actions for Initiative model.
 */
class InitiativeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Initiative models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            
            $searchModel = new InitiativeSearch();
            $initiatives = Initiative::findAll(['department_id' => $department->id, 'status'=>'9']);

            if(empty($initiatives)){
                return $this->redirect(['initiative/create']);
            }else{
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'initiatives' => $initiatives,
                ]);
            }
            
        }
    }

    /**
     * Displays a single Initiative model.
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
     * Creates a new Initiative model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            $strategic_objectives = StrategicObjective::findAll(['department' => $department->id, 'status' => 9]);
            $KPIs = KPI::findAll(['department' => $department->id, 'status' => 9]);
            
            if(!empty($strategic_objectives) || !empty($KPIs)){
                $model = new Initiative();
                $members = DepartmentMember::findAll(['department' => $department->id]);
                $depmembers = [];
                $depmembersMap = [];
                
                $i = 0;
                foreach($members as $member){
                    $depmembers[$i] = [Member::findOne(['id' => $member->member]), $member->id];
                    /* $depmembersMap[$i] = \yii\helpers\ArrayHelper::map(Member::find(['id' => $member->member])->select(['first_name','other_name','last_name', 'id'])->all(), 'id', 
                        function($depmembers, $i) {
                            return $depmembers[$i]->first_name . ' ' . $depmembers[$i]->other_name . ' ' . $depmembers[$i]->last_name;
                        }
                              ); */
                    $i += 1;
                }
                
                
                if ($model->load(Yii::$app->request->post())) {
                    $model->department_id = $department->id;
                    $model->created_by = User::getCurrentUserID();
                    $model->updated_by = User::getCurrentUserID();
                    $model->updated_at = 0;
                    $model->created_at = 0;
                    $model->status = 9;
                    //$departmentMember = DepartmentMember::findOne(['id' => $model->responsible_person]);
                    //$model->responsible_person = $departmentMember->member;

                    if($model->save()){
                        Yii::$app->session->setFlash('success', 'Initiative was successfully created.');
                        return $this->redirect(['index']);
                    }
                    Yii::$app->session->setFlash('error', 'Initiative was not successfully created. Please try again or contact the admin for assistance.');     
                    //var_dump($model->getErrors());
                    //var_dump($model->strategic_objective);
                
                }
        
                return $this->render('create', [
                    'model' => $model,
                    'depmembers' => $depmembers,
                ]);
            }else if (empty($KPIs)){
                Yii::$app->session->setFlash('error', 'You cannot create an initiative without a measure. Kindly create a KPI to proceed.');
                return $this->redirect(['k-p-i/create']);
            } else if(empty($strategic_objectives)){
                 Yii::$app->session->setFlash('error', 'You cannot create an initiative before a strategic objective. Kindly create an objective to proceed.');
                return $this->redirect(['strategic-objective/create']);
            }
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform this action. Kindly contact the admin for assistance.');
        return $this->redirect(['home/index']);
    }

    /**
     * Updates an existing Initiative model.
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
     * Deletes an existing Initiative model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            $model->status = 0;

            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Initiative was deleted successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Initiative was not deleted. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }
    
    
    
    //Restores a deleted model 
    public function actionRestore($id)
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            $model->status = 9;

            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Initiative was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Initiative was not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }
    
    

    /**
     * Finds the Initiative model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Initiative the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Initiative::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
