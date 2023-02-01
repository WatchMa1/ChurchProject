<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Address;
use app\models\RoleStatus;
use app\models\Department;
use app\models\DepartmentMember;
use app\models\DepartmentMemberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\MemberSearch;
use app\models\Member;


/**
 * DepartmentMemberController implements the CRUD actions for DepartmentMember model.
 */
class DepartmentMemberController extends Controller
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
     * Lists all DepartmentMember models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Department')) {
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);

        
            $searchModel = new DepartmentMemberSearch();
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
     * Displays a single DepartmentMember model.
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
     * Creates a new DepartmentMember model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $userid = Yii::$app->user->identity->id;
        $model = new DepartmentMember();
        $rolestatus = RoleStatus::findOne(['user' => $userid]);
        $department = Department::findOne(['id' => $rolestatus->department]);
        
        $data = Member::find()->select(['id as id', 'first_name', 'other_name', 'last_name'])->asArray()->all();
    
        $ah = \yii\helpers\ArrayHelper::map(Member::find()->select(['first_name','other_name','last_name', 'id'])->all(), 'id', 
            function($data) {
                return $data['first_name']. ' '.$data['other_name'].' '.$data['last_name'];
            }

        );
 
        if ($model->load(Yii::$app->request->post())) {
            
            $model->created_by = $userid;
            $model->updated_by = $userid;
            $model->updated_at = 0;
            $model->created_at = 0;
            $model->status = 9;
            $model->department = $department->id;
            
            
            
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Member was successfully created.');
                return $this->redirect(['index']);
            }
                Yii::$app->session->setFlash('error', 'Member was not created.Please contact the technical team for assistance.');
                return $this->goBack();
              
        }
        return $this->render('create', [
            'model' => $model,
            'ah' => $ah,
        ]);
    
    }

    /**
     * Updates an existing DepartmentMember model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $member = Member::findOne(['id' => $model->member]);
        
        $data = Member::find()->select(['id as id', 'first_name', 'other_name', 'last_name'])->asArray()->all();
    
        $ah = \yii\helpers\ArrayHelper::map(Member::find()->select(['first_name','other_name','last_name', 'id'])->all(), 'id', 
            function($data) {
                return $data['first_name']. ' '.$data['other_name'].' '.$data['last_name'];
            }

        );

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                Yii::$app->session->setFlash('success', 'Member was successfully created.');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        
            Yii::$app->session->setFlash('error', 'Member was not created. This member is not part of this congregation or the email is incorrect.');
            return $this->redirect(['index']);            
        }

        return $this->render('update', [
            'member' => $member,
            'model' => $model,
            'ah' => $ah,
        ]);
    }

    /**
     * Deletes an existing DepartmentMember model.
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
            Yii::$app->session->setFlash('primary', 'Department member was deleted successfully.');
            return $this->redirect(['index']);
        }
        Yii:$app->session->setFlash('error', 'Department member not deleted. Contact the Technical team for assistance.');
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
            $model->status = 0;

            
        if($model->save()){
            Yii::$app->session->setFlash('success', 'Department member was restored successfully.');
            return $this->redirect(['index']);
        }
        Yii:$app->session->setFlash('error', 'Department member not restored. Contact the Technical team for assistance.');
        return $this->redirect(['index']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['site/index']);
        }
    }

    /**
     * Finds the DepartmentMember model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DepartmentMember the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentMember::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
