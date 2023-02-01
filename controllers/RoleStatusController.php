<?php

namespace app\controllers;

use Yii;
use app\models\RoleStatus;
use app\models\User;
use app\models\Department;
use app\models\RoleStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * RoleStatusController implements the CRUD actions for RoleStatus model.
 */
class RoleStatusController extends Controller
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
     * Lists all RoleStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $session = Yii::$app->session;
        $department = $session['department'];
        $department = Department::findOne(['id' => $department]);
        
        if(isset($department)){
            if($department->name == 'Clerks'){
                $searchModel = new RoleStatusSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }else  {
                $pastroles = RoleStatus::findAll(['user' => Yii::$app->user->id]);
                $searchModel = new RoleStatusSearch();
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $pastroles,
                    'pagination' => [
                        'pageSize' => 10,
                    ],
                    'sort' => [
                        'attributes' => ['year'],
                    ],
                ]);
            
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
            }
            Yii::$app->session->setFlash('error', 'You are not authorised to perform this action. Kindly contact the admin for assistance.');
            return $this->redirect('home/index');
        }else if($session['role'] == 'Admin'){
             $searchModel = new RoleStatusSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform this action. Kindly contact the admin for assistance.');
        return $this->redirect('home/index');
    }

    /**
     * Displays a single RoleStatus model.
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
     * Creates a new RoleStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        if(!Yii::$app->user->isGuest){

            $session = Yii::$app->session;
            $model = new RoleStatus();

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = 0;
                $model->created_at = 0;
                $model->status = 9;
                $model->user = $session['user'];

                $user = User::findOne(['id' => $session['user']]);
                $user->role = $model->role;
                if($model->save() && $user->save()){
                    return $this->redirect(['home/', 'id' => $model->user]);
                }

                Yii::$app->session->setFlash('error', 'Sorry, your entry was not saved. Kindly contact the admin for assistance.');
                var_dump($model->getErrors());
                //return $this->redirect(['home/index']);  
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action. Kindly contact the admin for assistance.');
        return $this->redirect(['home/index']);  
    }

    /**
     * Updates an existing RoleStatus model.
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
     * Deletes an existing RoleStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the RoleStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RoleStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RoleStatus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
