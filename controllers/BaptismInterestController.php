<?php

namespace app\controllers;

use Yii;
use app\models\BaptismInterest;
use app\models\BaptismInterestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * BaptismInterestController implements the CRUD actions for BaptismInterest model.
 */
class BaptismInterestController extends Controller
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
           return $this->redirect(['home/index']);

		}
        return parent::beforeAction($action);
    }
    /**
     * Lists all BaptismInterest models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {

            $searchModel = new BaptismInterestSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
        if (User::userIsAllowedTo('Create Member')) {
            $user = Yii::$app->user->id;
            if (($model = BaptismInterest::findOne(['user' => $user])) !== null){
                $id = $model->id;
                return $this->redirect(['view', 'id' => $id]);
            } else {
                Yii::$app->session->setFlash('success', 'Do you wish to get baptised?');
                return $this->redirect(['register']);
            }

        } 
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Displays a single BaptismInterest model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
        if (User::userIsAllowedTo('Create Member')) {
            $user = Yii::$app->user->id;
            $model =$this->findModel(['user' => $user]);
            return $this->render('view', [
                'model' => $model,
            ]);       
        }

    }

    /**
     * Creates a new BaptismInterest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRegister()
    {
        $model = new BaptismInterest();
        $user = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            $model->user = $user;
            $model->state = '';
            $model->recieved_by = '';
            $model->return_comment = '';
            if ($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('error', 'Failed to perform that action.');

            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing BaptismInterest model.
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
     * Deletes an existing BaptismInterest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
            if($this->findModel($id)->delete()){
                Yii::$app->session->setFlash('success', 'Item deleted.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to perform that action.');
            }
            return $this->redirect(['index']);
        }
        if (User::userIsAllowedTo('Create Member')) {
            $user = Yii::$app->user->id;
            if($this->findModel(['user' => $user])->delete()){
                Yii::$app->session->setFlash('success', 'Item deleted.');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to perform that action.');
            }
            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the BaptismInterest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BaptismInterest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BaptismInterest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}