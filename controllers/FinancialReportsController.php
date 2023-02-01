<?php

namespace app\controllers;

use app\models\DepartmentalExpenseItemsSearch;
use app\models\FundItemsSearch;
use Yii;
use app\models\IncomesAndExpensesSearch;
use app\models\OfferingAndTitheSearch;
use app\models\User;
use pheme\grid\actions\ToggleAction;



class FinancialReportsController extends \yii\web\Controller
{
    
    public function beforeAction($action) {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('error', 'Log in to proceed with the operation.');
			return $this->redirect(['/']);
		}
        if (!User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
		}
        return parent::beforeAction($action);
    }
    public function actions(): array
    {
        return array_merge(parent::actions(), [
            'mp-toggle-column' => \MP\GridView\ToggleColumnAction::class,
        ]);
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionDepartmentalExpenditure()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen($year) == 4){
            $searchModel = new DepartmentalExpenseItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year);


            return $this->render('departmental-expenditure', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Select the year of reporting.');
            return $this->render('select-year', [
                'msg' => 'select year',
                'url' => 'departmental-expenditure',
            ]);
        }
    }
    public function actionMonthlyDepartmentalExpenditure()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen($year) == 4){
            $searchModel = new DepartmentalExpenseItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year);
            return $this->render('monthly-departmental-expenditure', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Select the year of reporting.');
            return $this->render('select-year', [
                'msg' => 'select year',
                'url' => 'monthly-departmental-expenditure',

            ]);
        }
    }
    public function actionTitheAndOfferingPerMember()
    {
        $searchModel = new OfferingAndTitheSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
            Yii::$app->session->setFlash('success', 'Showing entries for the year: '.$year.'.');
        } else {
            $year = date('Y');
            Yii::$app->session->setFlash('success', 'Year defaulted to: '.$year.'.');
        }
        return $this->render('member-tithe-offering', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
        
    }
    public function actionLocalFundsAggregatedSummary()
    {

        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
            Yii::$app->session->setFlash('success', 'Showing entries for the year: '.$year.'.');
        } else {
            $year = date('Y');
            Yii::$app->session->setFlash('success', 'Year defaulted to: '.$year.'.');
        }
        $category = 'local';
        $searchModel = new FundItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year,$category);

        return $this->render('aggregated-tithe-offering-local', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
        
    }
    public function actionTrustFundsAggregatedSummary()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
            Yii::$app->session->setFlash('success', 'Showing entries for the year: '.$year.'.');
        } else {
            $year = date('Y');
            Yii::$app->session->setFlash('success', 'Year defaulted to: '.$year.'.');
        }        
        $category = 'trust';
        $searchModel = new FundItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year,$category);

        return $this->render('aggregated-tithe-offering-trust', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
        
    }
    public function actionLocalFundsExpenditureSummary()
    {

        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
            Yii::$app->session->setFlash('success', 'Showing entries for the year: '.$year.'.');
        } else {
            $year = date('Y');
            Yii::$app->session->setFlash('success', 'Year defaulted to: '.$year.'.');
        }
        $category = 'local';
        $searchModel = new FundItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year,$category);

        return $this->render('aggregated-expenditure-local', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
        
    }
}