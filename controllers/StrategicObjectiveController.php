<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Department;
use app\models\StrategicObjective;
use app\models\StrategicObjectiveSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\data\ArrayDataProvider;

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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete', 'view', 'list'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete', 'view', 'list'],
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
     * Lists all StrategicObjective models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);

            $searchModel = new StrategicObjectiveSearch();
            $objectives = StrategicObjective::findAll(['department' => $department->id]);
            $dataProvider = new ArrayDataProvider([
                'allModels' => $objectives,
                'pagination' => [
                    'pageSize' => 10,
                ],
                'sort' => [
                    'attributes' => ['strategic_theme'],
                ],
            ]);

            if (empty($dataProvider)) {
                return $this->redirect('create');
            } else {
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider
                ]);
            }
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
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

        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);


            if ($model->load(Yii::$app->request->post())) {
                $model->department = $department->id;
                $model->created_by = User::getCurrentUserID();
                $model->updated_by = User::getCurrentUserID();
                $model->updated_at = 0;
                $model->created_at = 0;
                $model->status = 9;


                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Objective was successfully created.');
                    return $this->redirect(['index']);
                }
                Yii::$app->session->setFlash('error', 'Ojective was not successfully created.');
                var_dump($model->getErrors());
            }


            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
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
            return $this->redirect(['index']);
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
            $model->delete();
            /* $model->status = 0;

            
            if($model->save()){
                Yii::$app->session->setFlash('primary', 'Objective was deleted successfully.');
                return $this->redirect(['index']);
            } */
            Yii::$app->session->setFlash('error', 'Objective not deleted. Contact the Technical team for assistance.');
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
                Yii::$app->session->setFlash('success', 'Objective was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:
            $app->session->setFlash('error', 'Objective was not restored. Contact the Technical team for assistance.');
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