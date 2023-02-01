<?php

namespace app\controllers;

use Yii;
use app\models\PaymentRequest;
use app\models\PaymentRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
/**
 * PaymentRequestController implements the CRUD actions for PaymentRequest model.
 */
class PaymentRequestController extends Controller
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
     * Lists all PaymentRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
            $searchModel = new PaymentRequestSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Displays a single PaymentRequest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $myDepartment = $session['department'];
            return $this->render('view', [
                'model' => $this->findModel(['id'=>$id,'department'=>$myDepartment]),
            ]);
        }

        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Creates a new PaymentRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {

            $model = new PaymentRequest();
            $user = Yii::$app->user->id;
            $model->requested_by = $user;
            $session = Yii::$app->session;
            
            if ($model->load(Yii::$app->request->post())) {
                $model->date_required = strtotime($model->date_required);
                if (User::userIsAllowedTo('Manage Department')) {
                    $myDepartment = $session['department'];
                    $model->department = $myDepartment;       
                } 
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save. Retry.');
                }

            }
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);

    }

    /**
     * Updates an existing PaymentRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
            
            $model = $this->findModel($id);
            if (User::userIsAllowedTo('Manage Department')) {
                $session = Yii::$app->session;
                $myDepartment = $session['department'];
                $model = $this->findModel(['id'=>$id,'department'=>$myDepartment]);
            }
            if ($model->load(Yii::$app->request->post())) {
                
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save. Retry.');
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
     * Updates staus of an existing PaymentRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdateState($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $user = Yii::$app->user->id;
                $model->processed_by = $user;
                $model->processed_at = time();
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update-state', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Deletes an existing PaymentRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Users')) {
            if($this->findModel($id)->delete()){
                Yii::$app->session->setFlash('success', 'Deleted Successfully');
                return $this->redirect(['index']);
            }
        }

        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Finds the PaymentRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PaymentRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PaymentRequest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}