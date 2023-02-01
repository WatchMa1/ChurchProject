<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Department;
use app\models\ResponsiblePerson;
use app\models\ResponisblePersonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResponisblePersonController implements the CRUD actions for ResponsiblePerson model.
 */
class ResponisblePersonController extends Controller
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
     * Lists all ResponsiblePerson models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            
            $searchModel = new ResponisblePersonSearch();
            $persons = ResponsiblePerson::findAll(['department' => $department->id]);

           if(empty($persons)){
                return $this->redirect('responisble-person/create');
            }else{
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'persons' => $persons,
                ]);
            }
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
    }

    /**
     * Displays a single ResponsiblePerson model.
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
     * Creates a new ResponsiblePerson model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ResponsiblePerson();
        $model1 = new ResponsiblePerson();
        $model2 = new ResponsiblePerson();
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
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Person was successfully created.');
                return $this->redirect(['index']);
               }
            Yii::$app->session->setFlash('error', 'Person was not successfully created.');
            }

        return $this->render('create', [
            'model' => $model,
        ]);
        }else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Updates an existing ResponsiblePerson model.
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
     * Deletes an existing ResponsiblePerson model.
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
                Yii::$app->session->setFlash('primary', 'Responsible person was removed successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Responsible person not deleted. Contact the Technical team for assistance.');
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
                Yii::$app->session->setFlash('success', 'Responsible person was restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Responsible person not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Finds the ResponsiblePerson model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ResponsiblePerson the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ResponsiblePerson::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
