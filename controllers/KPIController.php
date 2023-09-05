<?php

namespace app\controllers;

use Yii;
use app\models\KPI;
use app\models\User;
use app\models\KPISearch;
use app\models\Department;
use app\models\StrategicObjective;
use app\models\StrategicObjectiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KPIController implements the CRUD actions for KPI model.
 */
class KPIController extends Controller
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
     * Lists all KPI models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);

            $searchModel = new KPISearch();
            $kpis = KPI::findAll(['department' => $department->id]);

            if (empty($kpis)) {
                return $this->redirect('k-p-i/create');
            } else {
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'kpis' => $kpis,
                ]);
            }
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['site/index']);
    }

    /**
     * Displays a single KPI model.
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
     * Creates a new KPI model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            $strategic_objectives = StrategicObjective::findAll(['department' => $department->id]);

            if (!empty($strategic_objectives)) {
                $model = new KPI();
                if ($model->load(Yii::$app->request->post())) {
                    $model->department = $department->id;
                    $model->created_by = User::getCurrentUserID();
                    $model->updated_by = User::getCurrentUserID();
                    $model->updated_at = 0;
                    $model->created_at = 0;
                    $model->status = 9;
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success',    'Department was successfully created.');
                        return $this->redirect(['index']);
                    }
                    Yii::$app->session->setFlash('error', 'The KPI was not saved. Please try again or contact the admin for assistance.');
                }
                return $this->render('create', [
                    'model' => $model,
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'You have not created a strategic objective yet. Create one to begin filling in the Scorecard.');
                return $this->redirect(['strategic-objective/create']);
            }
        }
    }
    /**
     * Updates an existing KPI model.
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
     * Deletes an existing KPI model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            $model->delete();


            /* if($model->save()){
                Yii::$app->session->setFlash('primary', 'KPI was deleted successfully.');
                return $this->redirect(['index']);
            } */
            Yii:
            $app->session->setFlash('error', 'KPI not deleted. Contact the Technical team for assistance.');
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


            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'KPI was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:
            $app->session->setFlash('error', 'KPI not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }


    /**
     * Finds the KPI model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return KPI the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = KPI::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}