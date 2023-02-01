<?php

namespace app\controllers;

use app\models\Address;
use app\models\Family;
use app\models\FamilyChildren;
use app\models\FamilyOther;
use app\models\FamilySearch;
use app\models\Department;
use app\models\MembershipStatus;
use app\models\MemberType;
use app\models\User;
use app\models\WorkPlace;
use Yii;
use app\models\Member;
use app\models\MemberSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\mail\Mail;

/**
 * MemberController implements the CRUD actions for Member model.
 */
class MemberController extends Controller
{
    public static $email;
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
     * Lists all Member models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Manage Users')) {
            $searchModel = new MemberSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere('status = '. 9);

            $famModel = new FamilySearch();
            $families = $famModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'families' => $families,
                'famModel' => $famModel
            ]);
        } else if(User::userIsAllowedTo('Manage Department')){
            $session = Yii::$app->session;
            $department = $session['department'];
            $department = Department::findOne(['id' => $department]);
            if($department->name == 'Clerks'){
                 $searchModel = new MemberSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

                $famModel = new FamilySearch();
                $families = $famModel->search(Yii::$app->request->queryParams);

                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'families' => $families,
                    'famModel' => $famModel
                ]);
            }
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }

    /**
     * Displays a single Member model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            if($model->created_by = Yii::$app->user->id) {
                return $this->render('view', [
                    'model' => $model,
                    'membership' => MembershipStatus::findOne(['id' => $model->membership_status]),
                    'address' => Address::findOne(['member' => $model->id]),
                    'work' => WorkPlace::findOne(['member' => $model->id])
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'You are not authorised to view this page.');
                return $this->redirect(['home/index']);
            }
        } else if(User::userIsAllowedTo('Manage Users')) {
            $model = $this->findModel($id);
            return $this->render('view', [
                'model' => $model,
                'membership' => MembershipStatus::findOne(['id' => $model->membership_status]),
                'address' => Address::findOne(['member' => $model->id]),
                'work' => WorkPlace::findOne(['member' => $model->id])
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(!isset(Yii::$app->session['family'])) {
            Yii::$app->session->setFlash('info', 'Provide your family details before creating your profile.');
            return $this->redirect(['family/create']);
        }
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = new Member();
            $membership = new MembershipStatus();
            $address = new Address();
            $work = new WorkPlace();
            if ($model->load(Yii::$app->request->post())) {
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 9;
                $membership->load(Yii::$app->request->post());
                $membership->created_by = Yii::$app->user->id;
                $membership->updated_by = Yii::$app->user->id;
                //$membership->status = 9;
                $membership->save();
                $address->load(Yii::$app->request->post());
                $address->created_by = Yii::$app->user->id;
                $address->updated_by = Yii::$app->user->id;
                //$address->status = 9;
                if($work->load(Yii::$app->request->post())) {
                    $work->created_by = Yii::$app->user->id;
                    $work->updated_by = Yii::$app->user->id;
                    $work->status = 9;
                }
                $model->membership_status = $membership->id;
                if ($model->save()) {
                    $address->member = $model->id;  
                    $address->save();
                    $work->member = $model->id;
                    $work->save();
                    $family = Family::findOne(['id' => Yii::$app->session['family']]);
                    $family->head_of_family = $model->id;
                    $family->save();
                    Yii::$app->session['member'] = $model->id;
                    Yii::$app->session->setFlash('success', 'Member details have been saved.');
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    Yii::$app->session->setFlash('error', 'Member details could not be saved.');
                }
            }

            return $this->render('create', [
                'model' => $model,
                'membership' => $membership,
                'address' => $address,
                'work' => $work
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    public function actionFamily() {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            if(!isset(Yii::$app->session['family'])) {
                Yii::$app->session->setFlash('info', 'Provide your family details before adding additional family members.');
                return $this->redirect(['family/create']);
            } else if(!isset(Yii::$app->session['member'])) {
                Yii::$app->session->setFlash('info', 'Provide your member details before adding additional family.');
                return $this->redirect(['family/create']);
            }
            $searchModel = new MemberSearch();
            $dataProvider = $searchModel->searchByFamily(Yii::$app->request->queryParams);

            return $this->render('family', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    public function actionViewFamily($id) {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Manage Department')) {
            $searchModel = new MemberSearch();
            $dataProvider = $searchModel->searchByFamilyId($id, Yii::$app->request->queryParams);

            return $this->render('view_family', [
                'id' => $id,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    /**
     * Creates a new Member model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateFamilySpouse()
    {
        if(!isset(Yii::$app->session['family'])) {
            Yii::$app->session->setFlash('info', 'Provide your family details before creating your profile.');
            return $this->redirect(['family/create']);
        }
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = new Member();
            $membership = new MembershipStatus();
            $address = new Address();
            $work = new WorkPlace();
            if ($model->load(Yii::$app->request->post())) {
                $family = Family::findOne(['id' => Yii::$app->session['family']]);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 9;
                $membership->load(Yii::$app->request->post());
                $membership->created_by = Yii::$app->user->id;
                $membership->updated_by = Yii::$app->user->id;
                $membership->status = 9;
                $membership->save();
                $address->load(Yii::$app->request->post());
                $address->created_by = Yii::$app->user->id;
                $address->updated_by = Yii::$app->user->id;
                $address->status = 9;
                if($work->load(Yii::$app->request->post())) {
                    $work->created_by = Yii::$app->user->id;
                    $work->updated_by = Yii::$app->user->id;
                    $work->status = 9;
                }
                $model->membership_status = $membership->id;
                if ($model->save()) {
                    $family->spouse = $model->id;
                    $family->save();
                    $address->member = $model->id;
                    $address->save();
                    $work->member = $model->id;
                    $work->save();
                    Yii::$app->session->setFlash('success', 'Member details have been saved.');
                    return $this->redirect(['family']);
                } else {
                    Yii::$app->session->setFlash('error', 'Member details could not be saved.');
                }
            }

            return $this->render('createFamily', [
                'model' => $model,
                'membership' => $membership,
                'address' => $address,
                'work' => $work
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    public function actionCreateFamilyChild()
    {
        if(!isset(Yii::$app->session['family'])) {
            Yii::$app->session->setFlash('info', 'Provide your family details before creating your profile.');
            return $this->redirect(['family/create']);
        }
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = new Member();
            $membership = new MembershipStatus();
            $address = new Address();
            $work = new WorkPlace();
            if ($model->load(Yii::$app->request->post())) {
                $family = Family::findOne(['id' => Yii::$app->session['family']]);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 9;
                $membership->load(Yii::$app->request->post());
                $membership->created_by = Yii::$app->user->id;
                $membership->updated_by = Yii::$app->user->id;
                $membership->status = 9;
                $membership->save();
                $address->load(Yii::$app->request->post());
                $address->created_by = Yii::$app->user->id;
                $address->updated_by = Yii::$app->user->id;
                $address->status = 9;
                if($work->load(Yii::$app->request->post())) {
                    $work->created_by = Yii::$app->user->id;
                    $work->updated_by = Yii::$app->user->id;
                    $work->status = 9;
                }
                $model->membership_status = $membership->id;
                if ($model->save()) {
                        $child = new FamilyChildren();
                        $child->family = $family->id;
                        $child->child = $model->id;
                        $child->created_by = Yii::$app->user->id;
                        $child->updated_by = Yii::$app->user->id;
                        $child->save();
                    $address->member = $model->id;
                    $address->save();
                    $work->member = $model->id;
                    $work->save();
                    Yii::$app->session->setFlash('success', 'Member details have been saved.');
                    return $this->redirect(['family']);
                } else {
                    Yii::$app->session->setFlash('error', 'Member details could not be saved.');
                }
            }

            return $this->render('createFamily', [
                'model' => $model,
                'membership' => $membership,
                'address' => $address,
                'work' => $work
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    public function actionCreateFamilyOther()
    {
        if(!isset(Yii::$app->session['family'])) {
            Yii::$app->session->setFlash('info', 'Provide your family details before creating your profile.');
            return $this->redirect(['family/create']);
        }
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = new Member();
            $membership = new MembershipStatus();
            $address = new Address();
            $work = new WorkPlace();
            if ($model->load(Yii::$app->request->post())) {
                $family = Family::findOne(['id' => Yii::$app->session['family']]);
                $model->created_by = Yii::$app->user->id;
                $model->updated_by = Yii::$app->user->id;
                $model->status = 9;
                $membership->load(Yii::$app->request->post());
                $membership->created_by = Yii::$app->user->id;
                $membership->updated_by = Yii::$app->user->id;
                $membership->status = 9;
                $membership->save();
                 if($address->load(Yii::$app->request->post())){
                    $address->created_by = Yii::$app->user->id;
                    $address->updated_by = Yii::$app->user->id;
                    $address->status = 9;
                    }
                if($work->load(Yii::$app->request->post())) {
                    $work->created_by = Yii::$app->user->id;
                    $work->updated_by = Yii::$app->user->id;
                    $work->status = 9;
                }
                $model->membership_status = $membership->id;
                if ($model->save()) {
                        $ofm = new FamilyOther();
                        $ofm->family = $family->id;
                        $ofm->other = $model->id;
                        $ofm->created_by = Yii::$app->user->id;
                        $ofm->updated_by = Yii::$app->user->id;
                        $ofm->status = 9;
                        $ofm->save();
                    $address->member = $model->id;
                    $address->save();
                    $work->member = $model->id;
                    $work->save();
                    Yii::$app->session->setFlash('success', 'Member details have been saved.');
                    return $this->redirect(['family']);
                } else {
                    Yii::$app->session->setFlash('error', 'Member details could not be saved.');
                }
            }

            return $this->render('createFamily', [
                'model' => $model,
                'membership' => $membership,
                'address' => $address,
                'work' => $work
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }
    
    public function actionSettings(){
        
        return $this->render('settings', ['model' => User::findOne(User::getCurrentUserID())]);
    }

    /**
     * Updates an existing Member model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            if($model->created_by == Yii::$app->user->id || User::userIsAllowedTo('Manage Users')) {
                $membership = MembershipStatus::findOne(['id' => $model->membership_status]);
                $address = Address::findOne(['member' => $model->id]);
                if(!isset($address)) {
                    $address = new Address();
                }
                $work = WorkPlace::findOne(['member' => $model->id]);
                if(!isset($work)) {
                    $work = new WorkPlace();
                }
                if ($model->load(Yii::$app->request->post())) {
                    $model->updated_by = Yii::$app->user->id;
                    if($membership->load(Yii::$app->request->post())) {
                        $membership->save();
                    }
                    if($address->load(Yii::$app->request->post())){ 
					   $address->member = $model->id;  
                       $address->save();
					}else {
                    var_dump($address->getErrors());
                    }
                    if($work->load(Yii::$app->request->post())) {
                        $work->save();
                    }
                    if($model->save()) {
                        var_dump($address->getErrors());
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                return $this->render('update', [
                    'model' => $model,
                    'membership' => $membership,
                    'address' => $address,
                    'work' => $work
                ]);
            } else {
                Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                return $this->redirect(['home/index']);
            }
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }
    
    public function actionChangepassword()
    {
        $user = User::findOne(User::getCurrentUserID());
        $model = new \app\models\LoginForm(['scenario' => 'change-password']);

        if ($model->load(Yii::$app->request->post())) {
            
            if (User::checkPassword($user, $model->password)) {
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->new_password.$user->auth);
                $user->save();
                Yii::$app->session->setFlash('Your password has been changed successfully');
                
                Mail::sendeMail($model->email);
                return $this->redirect('site/index');                
            } 
            $model->addError('password', 'Incorrect password.');
        }
        $model->password = '';
        return $this->render('changepassword', [
        'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Member model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if (User::userIsAllowedTo('Create Member') || User::userIsAllowedTo('Manage Department')) {
            $model = $this->findModel($id);
            if($model->id == Yii::$app->session['member']) {
                Yii::$app->session->setFlash('error', 'Member could not be deleted. Cannot delete the head od family.');
            } else if($model->created_by == Yii::$app->user->id) {
                $family = Family::findOne(['head_of_family' => Yii::$app->user->id]);
                if($family->spouse == $model->id) {
                    $family->spouse = null;
                    $family->save();
                }
                $fc = FamilyChildren::findOne(['child' => $model->id]);
                if($fc) {
                    $fc->status = 0;
                    $sf->save();
                }
                $fo = FamilyOther::findOne(['other' => $model->id]);
                if($fo) {
                    $fo->status = 0;
                    $f0->save();
                }
                $address = Address::findOne(['member' => $model->id]);
                if($address) {
                    $address->status = 0;
                    $address->save();
                }
                $work = WorkPlace::findOne(['member' => $model->id]);
                if($work) {
                    $work->status = 0;
                    $work->save();
                }
                $model->delete();
                Yii::$app->session->setFlash('success', 'Member has been deleted.');
            } else {
                Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
                return $this->redirect(['home/index']);
            }
            return $this->redirect(['family']);
        } else {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
        }
    }

    public function actionStatus() {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $id = $parents[0];
                $out = MemberType::find()->where(['group' => $id])->orderBy(['name' => SORT_ASC])->all();
                return ['output'=>$out, 'selected'=>''];
            }
        }
        return ['output'=>'', 'selected'=>''];
    }

    /**
     * Finds the Member model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Member the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Member::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    public function actionForgotpassword()
    {
        $this->layout = 'changepassword';
        
        $model = new \app\models\LoginForm(['scenario' => 'forgot-password']);

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByEmail($model->email);
            if (!empty($user)) {
                return $this->redirect('changepassword1');
            }
            $model->addError('email', 'No user with this email address');
        }
        return $this->render('forgotpassword', [
            'model' => $model,
            ]);
    }
    
    
    
    public function actionChangepassword1()
    {
        $this->layout = 'changepassword';
        
        
        $model = new \app\models\LoginForm(['scenario' => 'change-password1']);

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByEmail($model->email);
            if ($model->validate() && !empty($user)) {
                $user->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->confirm_password . $user->auth);
                $user->save();
                Yii::$app->session->setFlash('Your password has been changed successfully');
                
                Mail::sendeMail($model->email);
                return $this->render('emailSent');
            }
            $model->addError('email', 'No user with this email address.');
        }

        return $this->render('changepassword1', [
            'model' => $model,
        ]);
    }
    
    /**
     * Changes the member's .
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
}