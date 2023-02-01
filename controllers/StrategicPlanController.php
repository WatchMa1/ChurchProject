<?php

namespace app\controllers;

use app\models\Department;
use Yii;
use app\models\StrategicPlan;
use app\models\StrategicPlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
/**
 * StrategicPlanController implements the CRUD actions for StrategicPlan model.
 */
class StrategicPlanController extends Controller
{
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
     * Lists all StrategicPlan models.
     * @return mixed
     */
     public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Strategic Plan')) {
            
            $searchModel = new StrategicPlanSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else if(User::userIsAllowedTo('Manage Department')){
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'SPMEC'){
                
                $searchModel = new StrategicPlanSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                 ]);
            }
            Yii::$app->session->setFlash('error', 'You are not     authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
        Yii::$app->session->setFlash('error', 'You are not        authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Displays a single StrategicPlan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
      public function actionView($id)
    {
        if (User::userIsAllowedTo('Manage Strategic Plan')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'SPMEC'){
                return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
            
            Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
            return $this->redirect(['home/index']); 
            
            } else if(User::userIsAllowedTo('Manage Users')){
                 return $this->render('view', [
                    'model' => $this->findModel($id),
                ]);
            }
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']); 
    }

    /**
     * Creates a new StrategicPlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (User::userIsAllowedTo('Manage Strategic Plan')) {
            $model = new StrategicPlan();

            if ($model->load(Yii::$app->request->post())) {
                $model->id = Yii::$app->user->identity->id;
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = 0;
                $model->created_at = 0;
                $model->status = 9;
                
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'A Strategic Plan was successfully created.');
                    return $this->redirect(['index']);
                }
                Yii::$app->session->setFlash('error', 'Plan not saved.');
            }
            

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/index']);
    }

    /**
     * Updates an existing StrategicPlan model.
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
     * Deletes an existing StrategicPlan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Strategic Plan')) {
            $model = $this->findModel($id);
            $model->status = 0;

            
            if($model->save()){
                Yii::$app->session->setFlash('primary', 'Plan was deleted successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Plan not deleted. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }
    
    
    
    //Restores a deleted model 
    public function actionRestore($id)
    {
        if (User::userIsAllowedTo('Manage Strategic Plan')) {
            $model = $this->findModel($id);
            $model->status = 9;

            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Plan was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Plan not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }


    /**
     * Finds the StrategicPlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StrategicPlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StrategicPlan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}