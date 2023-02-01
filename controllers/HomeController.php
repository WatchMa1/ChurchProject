<?php


namespace app\controllers;


use app\models\User;
use Yii;
use yii\web\Controller;

class HomeController extends Controller
{
    /**
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (User::userIsAllowedTo('Create Member')) {
            if (!isset(Yii::$app->session['family'])) {
                return $this->redirect(['family/create']);
            } else if (!isset(Yii::$app->session['member'])) {
                return $this->redirect(['member/create']);
            }
            //return $this->redirect(['family/create']);
        }
        else if(User::userIsAllowedTo('Manage Department')){
            if (!isset(Yii::$app->session['family'])) {
                return $this->redirect(['family/create']);
            } else if (!isset(Yii::$app->session['member'])) {
                return $this->redirect(['member/create']);
            }
            return $this->redirect(['department/']);
        } else if(Yii::$app->user->isGuest){
			return $this->goHome();
		}

        return $this->render('index');
    }
}