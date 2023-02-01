<?php

namespace app\controllers;

use Yii;
use app\models\ChildDedication;
use app\models\ChildDedicationSearch;
use app\models\ChildDedicationSearchAdmin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use yii\debug\models\timeline\Search;

/**
 * ChildDedicationController implements the CRUD actions for ChildDedication model.
 */
class ChildDedicationController extends Controller
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
     * Lists all ChildDedication models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChildDedicationSearch();
        if (User::userIsAllowedTo('Manage Users')) {
            $searchModel = new ChildDedicationSearchAdmin();
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChildDedication model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $model =$this->findModel($id);
            return $this->render('view', [
                'model' => $model,
            ]);
        } 
        if (User::userIsAllowedTo('Create Member')) {
            $user = Yii::$app->user->id;
            $model =$this->findModel(['user_id' => $user,'id' => $id]);
            return $this->render('view', [
                'model' => $model,
            ]);
        } 
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);

    }

    /**
     * Creates a new ChildDedication model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChildDedication();
        
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            
            }
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ChildDedication model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Create Member')) {
            $user = Yii::$app->user->id;
            if (User::userIsAllowedTo('Manage Users')) {
                $model = $this->findModel($id);
            } else {
                $model = $this->findModel(['user_id' => $user,'id' => $id]);
            }
            if ($model->load(Yii::$app->request->post())) {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } 
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Deletes an existing ChildDedication model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action. Contact us for clarification.');
            return $this->redirect(['home/index']);
        }
    }
    
    /**
     * Approves an existing ChildDedication model.
     * If aproved is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionApprove($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            $model->status = 1;
            $user = $model->user_id;
            $usermodel = User::findOne($user);
            $username = (is_object($usermodel)) ? 'by '.$usermodel->fullName : '';
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'You have Approved the child dedication request '.$username);
            }
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action. Contact us for clarification.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Finds the ChildDedication model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChildDedication the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChildDedication::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}