<?php

namespace app\controllers;

use Yii;
use app\models\RemindersAndNotices;
use app\models\RemindersAndNoticesSearch;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RemindersAndNoticesController implements the CRUD actions for RemindersAndNotices model.
 */
class RemindersAndNoticesController extends Controller
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
    public function beforeAction($action) {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('error', 'Log in to proceed with the operation.');
			return $this->redirect(['/']);
		}
       
        return parent::beforeAction($action);
    }
    /**
     * Lists all RemindersAndNotices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RemindersAndNoticesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RemindersAndNotices model.
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
     * Creates a new RemindersAndNotices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Manage Department')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
		}
        $model = new RemindersAndNotices();

        if ($model->load(Yii::$app->request->post())) {
            if (User::userIsAllowedTo('Manage Department')) {
                $myDepartment = Yii::$app->session['department'];
                $model->send_to = 'department';       
                $model->audience = $myDepartment;       
            } 
            if (User::userIsAllowedTo('Manage Users')) {
                $myDepartment = Yii::$app->session['department'];
                if($model->send_to = 'all'){
                    $model->audience = 0;       
                }       

            } 
            $model->title = strtoupper($model->title);
            $model->date_of_notice = strtotime($model->date_of_notice);
            $model->added_by = Yii::$app->user->id;
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
                
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RemindersAndNotices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $myDepartment = Yii::$app->session['department'];
        $modelDepartment = $model->audience;
        $modelSendTo = $model->send_to;
        if (User::userIsAllowedTo('Manage Users') || (User::userIsAllowedTo('Manage Department') && $modelDepartment==$myDepartment && $modelSendTo=='department')) {
            if ($model->load(Yii::$app->request->post())) {
                $model->title = strtoupper($model->title);
                $model->date_of_notice = strtotime($model->date_of_notice);

                if (User::userIsAllowedTo('Manage Department')) {
                    $myDepartment = Yii::$app->session['department'];
                    $model->send_to = 'department';       
                    $model->audience = $myDepartment;       
                } 
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['index']);

        }
    }

    /**
     * Deletes an existing RemindersAndNotices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $myDepartment = Yii::$app->session['department'];
        $modelDepartment = $model->audience;
        $modelSendTo = $model->send_to;
        if (User::userIsAllowedTo('Manage Users') || (User::userIsAllowedTo('Manage Department') && $modelDepartment==$myDepartment && $modelSendTo=='department')) {

            if($model->delete()){
                Yii::$app->session->setFlash('success', 'Item Deleted.');
            }
            

            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['index']);

        }
    }

    /**
     * Finds the RemindersAndNotices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RemindersAndNotices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RemindersAndNotices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
