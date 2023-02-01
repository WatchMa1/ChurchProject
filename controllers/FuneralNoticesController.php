<?php

namespace app\controllers;

use Yii;
use app\models\FuneralNotices;
use app\models\FuneralNoticesSearch;
use app\models\FuneralNoticesSearchAdmin;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\User;

/**
 * FuneralNoticesController implements the CRUD actions for FuneralNotices model.
 */
class FuneralNoticesController extends Controller
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
     * Lists all FuneralNotices models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $searchModel = new FuneralNoticesSearch();
        if (User::userIsAllowedTo('Manage Users')) {
            $searchModel = new FuneralNoticesSearchAdmin();
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FuneralNotices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){

        $user = Yii::$app->user->id;
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
        } else {
            $model = $this->findModel(['notified_by' => $user,'id' => $id]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new FuneralNotices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FuneralNotices();
        if ($model->load(Yii::$app->request->post())) {
            $model->date_of_death = strtotime($model->date_of_death);
            $model->date_of_birth = strtotime($model->date_of_birth);
            $model->notified_by = Yii::$app->user->id;
            $file = UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $filename = 'Funeral_Photo_' . rand(5,10) . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                $model->photo = $filename;
                $file->saveAs('uploads/funeral_photo/' . $filename);
            } 
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Notice saved.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else{
                Yii::$app->session->setFlash('error', 'Notice details could not be saved.');
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing FuneralNotices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
 
        $user = Yii::$app->user->id;
        if (User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
        } else {
            $model = $this->findModel(['notified_by' => $user,'id' => $id]);
        }
        $old_photo = $model->photo;
        if ($model->load(Yii::$app->request->post())) {
            $model->date_of_death = strtotime($model->date_of_death);
            $model->date_of_birth = strtotime($model->date_of_birth);
            $file = UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $filename = 'Funeral_Photo_' . rand(5,10) . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                $model->photo = $filename;
                $file->saveAs('uploads/funeral_photo/' . $filename);
            } else {
                $model->photo = $old_photo;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Notice saved.');
                return $this->redirect(['view', 'id' => $model->id]);
            } else{
                Yii::$app->session->setFlash('error', 'Notice details could not be saved.');
            }
        }
        $model->date_of_birth = date('Y-m-d',$model->date_of_birth);
        $model->date_of_death = date('Y-m-d',$model->date_of_death);
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionMarkSeen($id)
    {
        if (!User::userIsAllowedTo('Manage Users')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
        $model = $this->findModel($id);
        $model->status = 1;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Notice marked as recieved.');
            return $this->redirect(['index']);
        } else{
            Yii::$app->session->setFlash('error', 'Notice could not be marked as recieved. Retry');
        }

    }

    /**
     * Deletes an existing FuneralNotices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!User::userIsAllowedTo('Manage Users')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the FuneralNotices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FuneralNotices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FuneralNotices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}