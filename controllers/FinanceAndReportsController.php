<?php

namespace app\controllers;

use app\models\IncomesAndExpensesSearch;
use app\models\User;
use Yii;

class FinanceAndReportsController extends \yii\web\Controller
{

    public function beforeAction($action) {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('error', 'Log in to proceed with the operation.');
			return $this->redirect(['home/index']);
		}
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Manage Department') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
		}
        return parent::beforeAction($action);
    }
    public function actionIndex()
    {

        
        return $this->render('index');
    }


}