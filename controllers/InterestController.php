<?php

namespace app\controllers;

use Yii;
use app\models\Interest;
use app\models\InterestSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Department;

/**
 * InterestController implements the CRUD actions for Interest model.
 */
class InterestController extends Controller
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
     * Lists all Interest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Interest Coordinator'){
                $searchModel = new InterestSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            Yii::$app->session->setFlash('error', 'You are not     authorised to perform that action.');
            return $this->redirect(['home/index']);
        } else if(User::userIsAllowedTo('Manage Users')){
            $searchModel = new InterestSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);
            }
        Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
        return $this->redirect(['home/index']);  
    }

    /**
     * Displays a single Interest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Interest Coordinator'){
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
     * Creates a new Interest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        if(Yii::$app->user->isGuest){
			$model = new Interest();
            if ($model->load(Yii::$app->request->post())) {
                    $model->created_by = Yii::$app->user->id;
                    $model->updated_by = Yii::$app->user->id;
                    $model->updated_at = 0;
                    $model->created_at = 0;
                    
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                     Yii::$app->session->setFlash('error', 'Something happened, Visitor details could not be saved. Please contact the admin.');
                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
        }else if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Interest Coordinator'){
                $model = new Interest();

                if ($model->load(Yii::$app->request->post())) {
                    $model->created_by = Yii::$app->user->id;
                    $model->updated_by = Yii::$app->user->id;
                    $model->updated_at = 0;
                    $model->created_at = 0;
                    $model->id = 0;
                    $model->status = 9;
                    
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                     Yii::$app->session->setFlash('error', 'Something happened, Visitor details could not be saved. Please contact the admin.');
                    var_dump($model->getErrors());
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
            Yii::$app->session->setFlash('error', 'Sorry. You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
			}
        } else if(Yii::$app->user->isGuest && User::userIsAllowedTo('Manage Users')){
                if ($model->load(Yii::$app->request->post())) {
                    $model->created_by = Yii::$app->user->id;
                    $model->updated_by = Yii::$app->user->id;
                    $model->updated_at = 0;
                    $model->created_at = 0;
                    
                    if($model->save()){
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                     Yii::$app->session->setFlash('error', 'Something happened, Visitor details could not be saved. Please contact the admin.');
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else{
                Yii::$app->session->setFlash('error', 'Sorry. You are not authorised to perform that action.');
                return $this->redirect(['home/index']);
            }
        
    }

    /**
     * Updates an existing Interest model.
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
     * Deletes an existing Interest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Department') ||   User::userIsAllowedTo('Manage Users')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Interest Coordinator'){
                $model = $this->findModel($id);
                $model->status = 0;
                if($model->save()){
                    Yii::$app->session->setFlash('primary', 'Interest was deleted successfully.');
                    return $this->redirect(['index']);
                }
                Yii:$app->session->setFlash('error', 'Interest not deleted. Contact the Technical team for assistance.');
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
            return $this->redirect(['home/index']); 
        }
         Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
        return $this->redirect(['home/index']); 
    }

    
    //Restores a deleted Model
    public function actionRestore($id)
    {
        if (User::userIsAllowedTo('Manage Department') ||   User::userIsAllowedTo('Manage Users')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Interest Coordinator'){
                $model = $this->findModel($id);
                $model->status = 9;
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Interest was restored successfully.');
                    return $this->redirect(['index']);
                }
                Yii:$app->session->setFlash('error', 'Interest not restored. Contact the Technical team for assistance.');
                return $this->redirect(['index']);
            }
            Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
            return $this->redirect(['home/index']); 
        }
         Yii::$app->session->setFlash('error', 'You are not         authorised to perform that action.');
        return $this->redirect(['home/index']); 
    }
    
    
    
    /**
     * Finds the Interest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Interest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Interest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
