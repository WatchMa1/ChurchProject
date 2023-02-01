<?php

namespace app\Controllers;

use Yii;
use app\models\StrategicObjective;
use app\models\StrategicObjectiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StrategicObjectiveController implements the CRUD actions for StrategicObjective model.
 */
class StrategicObjectiveController extends Controller
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
     * Lists all StrategicObjective models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StrategicObjectiveSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StrategicObjective model.
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
     * Creates a new StrategicObjective model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StrategicObjective();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->status = 9;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StrategicObjective model.
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
     * Deletes an existing StrategicObjective model.
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
     * Finds the StrategicObjective model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StrategicObjective the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StrategicObjective::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
