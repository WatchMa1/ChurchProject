<?php

namespace app\controllers;

use Yii;
use app\mail\Mail;
use app\models\Role;
use app\models\User;
use app\models\UserSearch;
use app\models\Department;
use app\models\RoleStatus;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use MP\SelectModel\MPModelSelectAction;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\base\Exception
     */
    public function actionCreate()
    {
        $model = new User();
        $rolestatus = new RoleStatus();

        if ($model->load(Yii::$app->request->post()) && $rolestatus->load(Yii::$app->request->post())) {
            $user = User::findByEmail($model->email);
            if(empty($user)){
                $model->status = User::STATUS_INACTIVE;
                $model->auth = Yii::$app->security->generateRandomString();
                $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->email.$model->auth);
                //$model->updated_by = Yii::$app->user->identity->id;
                $model->updated_by = 1;
            
                if($model->save() && $rolestatus->load(Yii::$app->request->post())) {                
                    $rolestatus->role = $model->role;
                    $rolestatus->user = $model->id;
                    $rolestatus->created_by = Yii::$app->user->identity->id;
                    $rolestatus->updated_by = Yii::$app->user->identity->id;
                    $rolestatus->updated_at = 0;
                    $rolestatus->created_at = 0;
                
				    //$rolestatus->id = 1;
                
                    if($rolestatus->save()){
                        Mail::sendMail($model->email, $model->email, $model);
                        Yii::$app->session->setFlash('success', 'User account was successfully created.');
                        return $this->redirect(['index']);
                    } else{
                        //print_r($rolestatus->getErrors());
                        Yii::$app->session->setFlash('error', "User account created but Role Status not saved!");
                    }
                } else {
                    Yii::$app->session->setFlash('error', "User account created but email not sent!");
                }
            }
            Yii::$app->session->setFlash('error', 'Sorry. A user account already exists with this email.');
        }

        return $this->render('createAdmin', [
            'model' => $model,
            'rolestatus' => $rolestatus,
        ]);
    }
    

    public function actionGuestCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->status = User::STATUS_INACTIVE;
            $model->auth = Yii::$app->security->generateRandomString();
            $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->email.$model->auth);
            $model->updated_by = 1;
            $model->role = 1;
        
            if($model->save()) {             
                if(Mail::sendMail($model->email, $model->email, $model)){
                    Yii::$app->session->setFlash('success', 'User account succefully created.');
                    return $this->redirect(['site/index']);
                } else {
                    Yii::$app->session->setFlash('error', 'User account created but mail with user credentials was not sent. Please contact the Admin for assistance.');
                    return $this->redirect(['site/index']);
                }
            } else {
                var_dump($model->getErrors());
                Yii::$app->session->setFlash('error', "User account created but email not sent!");

            }
        }
        $this->layout = 'main2';
        return $this->render('create', [
            'model' => $model,
        ]);
    }
    
    
    //This function activates a user account
    public function actionActivateUser($id){
        $model = User::findOne($id);
        $model->status = 9;
        if($model->save()){
            Mail::sendActivationMail($model->email, $model->email, $model);
            Yii::$app->session->setFlash('success', 'Account successfully activated.');
            
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', 'Sorry. Account not activated successfully.');
        return $this->redirect(['index']);
    }
    
    
    //This function activates all inactive user accounts
    public function actionActivateUsers(){
        $users = User::findAll(['status' => 8]);
        foreach ($users as $user){
            User::activateUser($user->id);
        }
        Yii::$app->session->setFlash('success', 'All accounts were activated.');
        return $this->redirect(['index']);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
	    $rolestatus = Rolestatus::findOne(['user' => $id]);

        if ($model->load(Yii::$app->request->post()) && $rolestatus->load(Yii::$app->request->post())) {
            $model->role = $rolestatus->role;
            if($model->save() && $rolestatus->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
            Yii::$app->session->setFlash('error', 'Sorry, the changes were not succefully made.');
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('update', [
            'model' => $model,
	        'rolestatus' => $rolestatus,
        ]);
    }
    
    
    
    

    /**
     * Deletes an existing User model.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model->status == 0) {
            Yii::$app->session->setFlash('error', "User account has already been deleted!");
        } else {
            $model->status = 0;
            $model->save();
            Yii::$app->session->setFlash('success', "User account has been deleted!");
        }
        return $this->redirect(['index']);
    }

    /**
     * Restores an existing User model.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionRestore($id)
    {
        $model = $this->findModel($id);
        if($model->status == 8 || $model->status == 9) {
            Yii::$app->session->setFlash('error', "User account has already been restored!");
        } else {
            if($model->validatePassword($model->email)) {
                $model->status = 8;
                //send email
            } else {
                $model->status = 9;
                //send email
            }
            $model->save();
            Yii::$app->session->setFlash('success', "User account has been restored!");
        }
        return $this->redirect(['index']);
    }

    
    
     /**
     * Deactivates an existing User model.
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionDeactivate($id)
    {
        $model = $this->findModel($id);
        if($model->status == 8) {
            Yii::$app->session->setFlash('error', "User account has already been Deactivated!");
        } else {
            $model->status = User::STATUS_INACTIVE;
            $model->save();
            Yii::$app->session->setFlash('success', "User account has been de-activated!");
        }
        return $this->redirect(['index']);
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionDepartment() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                if($id = 2 || $id = 3 || $id = 4){
                    $out = Department::findAll()->orderBy(['name' => SORT_ASC]);
                    return ['output'=>$out, 'selected'=>''];
                }
            }
            return ['output'=>'', 'selected'=>'No parents'];
        }
        return ['output'=>'', 'selected'=>'No parents'];
    }
    
    
    public function actionDepartments() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $role = $parents[0];
                if(Role::findOne(['id' => $role])->name == "Departmental Head"){
                    $departments = Department::find()->where(['status'=> 9])->orderBy(['name' => SORT_ASC])->all();
                    $out = [];
                    $i = 0;
                    foreach($departments as $department){
                        $out[$i] = ['id' => $department->id, 'name' => $department->name];
                        $i = $i + 1;
                    }
                    // the getSubCatList function will query the database based on the
                    // cat_id and return an array like below:
                    // [
                    // ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                    // ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                    // ]

                    echo Json::encode(['output'=>$out, 'selected'=> '']);
		            return;
                }
                return ['output'=>'', 'selected'=>'No parents'];
            }
            return ['output'=>'', 'selected'=>'No parents'];
        }
        return ['output'=>'', 'selected'=>''];
    }
}