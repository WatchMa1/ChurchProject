<?php

namespace app\controllers;

use app\models\Family;
use app\models\Member;
use app\models\Role;
use app\models\Right;
use app\models\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\RoleStatus;
use app\models\RightStatus;
use app\models\Department;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'login';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post())) {
            
            $user = User::findByEmail($model->email);
            if(!empty($user) && $user->status == 9){
                if(User::checkPassword($user, $model->password)){
                    $model->login();
                    $session = Yii::$app->session;
                    $session['name'] = $user->getFullName();
                    $session['user'] = $user->id;
                    $member = Member::findOne(['created_by' => $user->id]);
                    if(!empty($member)) {
                        $session['member'] = $member->id;
                    }
                    $family = Family::findOne(['created_by' => $user->id]);
                    if(!empty($family)) {
                        $session['family'] = $family->id;
                    }
                    
                    
                    $rolestatus = RoleStatus::findOne(['user' => $user->id]);
                    if(!empty($rolestatus)){
                        $session['role'] = Role::findOne(['id' => $rolestatus->role])->name;
                        $session['id'] = $rolestatus->role;
                        $rightstatuses = RightStatus::findAll(['role' => $rolestatus->role]);
                        
                        $i = 0;
                        $activerights = [];
                        foreach($rightstatuses as $right){
                            if($right->status == 9)
                            {
                                $activerights[$i] = Right::findOne(['id' => $right->right])->name;
                                $i = $i + 1;
                            }
                        }
                        $session['rights'] = $activerights;
                        
                        $department = Department::findOne($rolestatus->department);
                        if(!empty($department)){
                            $session['department'] = $department->id;
                        }
                        if($user->password_hash === Yii::$app->security->generatePasswordHash($user->email . $user->auth)){
        
                            Yii::$app->session->setFlash('You are not secure. Please change your password.');
                             return $this->redirect(['home/index']);
                        } 
                        return $this->redirect(['home/index']);
                    }else {
                        Yii::$app->session->setFlash('info', 'Please fill in your details.');
                        return $this->redirect(['role-status/create']);
                    }
                    
                }
                $model->password = '';
                $model->addError('password', 'Incorrect password.');
            } else {
                $model->password = '';
                $model->addError('email', 'Incorrect email address or user account is not activated.');
            }
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
