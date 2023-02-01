<?php

namespace app\controllers;

use app\models\FamilyChildren;
use app\models\FamilyOther;
use app\models\User;
use Yii;
use app\models\Family;
use app\models\FamilySearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FamilyController implements the CRUD actions for Family model.
 */
class FamilyController extends Controller
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
     * Lists all Family models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $searchModel = new FamilySearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Displays a single Family model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
            return $this->render('view', [
                'model' => $this->findModel(Yii::$app->session['family']),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Creates a new Family model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            if(isset(Yii::$app->session['family'])) {
                return $this->redirect(['view']);
            }
            $model = new Family();
            $model->scenario = 'create';
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 9;
                $file = UploadedFile::getInstance($model, 'family_photo');
                if (!empty($file)) {
                    $filename = 'Family_Photo_' . Yii::$app->user->id . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                    $model->family_photo = $filename;
                    $file->saveAs('uploads/family_photo/' . $filename);
                
                    if ($model->save()) {
                        Yii::$app->session['family'] = $model->id;
                        Yii::$app->session->setFlash('success', 'Family details have been saved.');
                        return $this->redirect(['view']);
                    } else{
                        Yii::$app->session->setFlash('error', 'Family details could not be saved.');
                    }
                }
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
     * Updates an existing Family model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        $model = $this->findModel(Yii::$app->session['family']);
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department') && $model->created_by == Yii::$app->user->id) {
            $old_photo = $model->family_photo;
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $file = UploadedFile::getInstance($model, 'family_photo');
                if (!empty($file)) {
                    $filename = 'Family_Photo_' . Yii::$app->user->id . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                    $model->family_photo = $filename;
                    $file->saveAs('uploads/family_photo/' . $filename);
                } else {
                    $model->family_photo = $old_photo;
                }
                if ($model->save()) {
                    Yii::$app->session['family'] = $model->id;
                    Yii::$app->session->setFlash('success', 'Family details have been updated.');
                    return $this->redirect(['view']);
                } else{
                    Yii::$app->session->setFlash('error', 'Family details could not be updated.');
                }
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Deletes an existing Family model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Create Member')) {
            $model = $this->findModel($id);
            if(FamilyOther::find()->where(['family' => $model->id, 'status' => 9]) || FamilyChildren::find()->where(['family' => $model->id, 'status' => 9])) {
                Yii::$app->session->setFlash('error', 'Family details could not be deleted. Delete family members first.');
            } else {
                $model->status = 0;

            
                if($model->save()){
                    Yii::$app->session->setFlash('primary', 'Famil details were deleted successfully.');
                    return $this->redirect(['index']);
                }
                Yii:$app->session->setFlash('error', 'Family details were not deleted. Contact the Technical team for assistance.');
                return $this->redirect(['index']);
            }
            //return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    
    
    public function actionRestore($id)
    {
        if (User::userIsAllowedTo('Create Member')) {
            $model = $this->findModel($id);
            $model->status = 9;
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Family details were restored successfully.');
                return $this->redirect(['index']);
            }
            Yii:$app->session->setFlash('error', 'Family details were not restored. Contact the Technical team for assistance.');
            return $this->redirect(['index']);
            //return $this->redirect(['index']);
            
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }
    
    /**
     * Finds the Family model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Family the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Family::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}