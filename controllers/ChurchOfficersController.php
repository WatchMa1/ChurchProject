<?php

namespace app\controllers;

use Yii;
use app\models\ChurchOfficers;
use app\models\ChurchOfficersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use MP\SelectModel\MPModelSelectAction;
use app\models\ChurchPositions;
use app\models\Role;
use app\models\User;
use app\models\Department;
use app\models\RoleStatus;
/**
 * ChurchOfficersController implements the CRUD actions for ChurchOfficers model.
 */
class ChurchOfficersController extends Controller
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
    public function actions(): array
    {
        return array_merge(parent::actions(), [
            'model-search' => [
                'class' => MPModelSelectAction::class,
            ],
        ]);
    }
    /**
     * Lists all ChurchOfficers models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ChurchOfficersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ChurchOfficers model.
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
     * Creates a new ChurchOfficers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChurchOfficers();
        $model->added_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post())) {
            $user = $model->user_id;
            $position_id = $model->position_id;
            $positionmodel = ChurchPositions::findOne($position_id);

            $year = $model->year;
            $role = ($positionmodel->role_id) ? $positionmodel->role_id : null;
            $department = ($positionmodel->department_id) ? $positionmodel->department_id : null;
            $usermodel = User::findOne($user);
            $rolestatus = Rolestatus::findOne(['user' => $user]);

            if ($role == null) {
                Yii::$app->session->setFlash('error', 'cannont assign NULL role.');
            } else {   
                if ($usermodel == null) {
                    Yii::$app->session->setFlash('error', 'User does not exist.');
                } else {
                    if ($model->save()) {
                        $usermodel->role = $role; //update user role
                        // i can now save the updated user
                        if ($usermodel->save()) {
                            $rolestatus->role = $role;
                            $rolestatus->department = $department;
                            $rolestatus->year = $year;
                            if ($rolestatus->save()) {
                                Yii::$app->session->setFlash('success', 'Saved successfully');
                                 return $this->redirect(['view', 'id' => $model->id]);
        
                            } else {
                                Yii::$app->session->setFlash('error', 'Failed to update departmet & role.');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Failed to update user role.');
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to save data.');
                    }
                }
            }
            
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ChurchOfficers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->added_by = Yii::$app->user->identity->id;
            $user = $model->user_id;
            $position_id = $model->position_id;
            $positionmodel = ChurchPositions::findOne($position_id);

            $year = $model->year;
            $role = ($positionmodel->role_id) ? $positionmodel->role_id : null;
            $department = ($positionmodel->department_id) ? $positionmodel->department_id : null;
            $usermodel = User::findOne($user);
            if ($role == null) {
                Yii::$app->session->setFlash('error', 'cannont assign NULL role.');
            } else {   
                if ($usermodel == null) {
                    Yii::$app->session->setFlash('error', 'User does not exist.');
                } else {
                    $rolestatus = Rolestatus::findOne(['user' => $user]);
                    if ($model->save()) {
                        $usermodel->role = $role; //update user role
                        // i can now save the updated user
                        if ($usermodel->save()) {
                            $rolestatus->role = $role;
                            $rolestatus->department = $department;
                            $rolestatus->year = $year;
                            if ($rolestatus->save()) {
                                Yii::$app->session->setFlash('success', 'Updated successfully');
                                return $this->redirect(['view', 'id' => $model->id]);
                            } else {

                                Yii::$app->session->setFlash('error', 'Failed to update departmet & role.');
                            }
                        } else {
                            Yii::$app->session->setFlash('error', 'Failed to update user role.'.$role);
                        }
                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to save data.');
                    }
                }
            }
            
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ChurchOfficers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $user = $model->user_id;
        $usermodel = User::findOne($user);
        $rolestatus = Rolestatus::findOne(['user' => $user]);
        $rolestatus->role = 1;
        $usermodel->role = 1; 
        $rolestatus->department = null;
        $rolestatus->year = date('Y');
        
        if($model->delete()){ 
            if ($rolestatus->save() && $usermodel->save()) {
                Yii::$app->session->setFlash('success', 'Successfully removed from the position');
            } else {
                Yii::$app->session->setFlash('error', 'Failed to update departmet & role.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Failed. Retry.');  
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the ChurchOfficers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChurchOfficers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChurchOfficers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}