<?php

namespace app\controllers;

use Yii;
use app\models\RightStatus;
use app\models\RightStatusSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RightStatusController implements the CRUD actions for RightStatus model.
 */
class RightStatusController extends Controller
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
     * Lists all RightStatus models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RightStatusSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RightStatus model.
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
     * Creates a new RightStatus model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RightStatus();
        $session = Yii::$app->session;

        if ($model->load(Yii::$app->request->post())) {
            $model->status = 9;
            $model->created_by = $session['user'];
            $model->updated_by = $session['user'];
            $model->updated_at = 0;
            $model->created_at = 0;
            $model->status = 9;
            
            if($model->save()){
                return $this->redirect(['role/view', 'id' => $model->role]);
            } else{
                Yii::$app->session->setFlash('error', 'Right not added successfully.');
                print_r($model->getErrors());
                //return $this->goBack();
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RightStatus model.
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
     * Deletes an existing RightStatus model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
            $model = $this->findModel($id);
            $model->status = 0;

            
            if($model->save()){
                return $this->redirect(['index']);
            }
            return $this->redirect(['index']);
    }
    
    
    
    //Restores a deleted model 
    public function actionRestore($id)
    {
            $model = $this->findModel($id);
            $model->status = 9;

            
            if($model->save()){
                return $this->redirect(['index']);
            }
            return $this->redirect(['index']);
    }


    /**
     * Finds the RightStatus model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RightStatus the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RightStatus::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
