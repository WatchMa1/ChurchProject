<?php

namespace app\controllers;

use Yii;
use app\models\Department;
use app\models\DepartmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use app\models\RoleStatus;

/**
 * DepartmentController implements the CRUD actions for Department model.
 */
class DepartmentController extends Controller
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
     * Lists all Department models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Users')) {
            
            $searchModel = new DepartmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere('status = '. 9);

            return $this->render('index1', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else if(User::userIsAllowedTo('Manage Department')){
            
            $searchModel = new DepartmentSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }
    /**
     * Displays a single Department model.
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
     * Creates a new Department model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = new Department();

            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->identity->id;
                $model->updated_by = Yii::$app->user->identity->id;
                $model->updated_at = 0;
                $model->created_at = 0;
                $model->status = 9;
				//$model->id = 1;
                if($model->save()){
                    Yii::$app->session->setFlash('success', 'Department was successfully created.');
                    return $this->redirect(['index']);
                }
            }
            

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Updates an existing Department model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Deletes an existing Department model.
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
                Yii::$app->session->setFlash('primary', 'Department was deleted successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Department not deleted. Contact the Technical team for assistance.');
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
                Yii::$app->session->setFlash('success', 'Department was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Department not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Finds the Department model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Department the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            if (($model = Department::findOne($id)) !== null) {
                return $model;
            }

            throw new NotFoundHttpException('The requested page does not exist.');
        
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }
}