<?php

namespace app\controllers;

use app\models\FundItems;
use Yii;
use app\models\IncomesAndExpenses;
use app\models\IncomesAndExpensesSearch;
use app\models\OfferingAndTitheReceipts;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * IncomesAndExpensesController implements the CRUD actions for IncomesAndExpenses model.
 */
class IncomesAndExpensesController extends Controller
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
    public function beforeAction($action) {
        if(Yii::$app->user->isGuest){
            Yii::$app->session->setFlash('error', 'Log in to proceed with the operation.');
			return $this->redirect(['/']);
		}
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Manage Department')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
		}
        return parent::beforeAction($action);
    }
    /**
     * Lists all IncomesAndExpenses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new IncomesAndExpensesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single IncomesAndExpenses model.
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
     * Creates a new IncomesAndExpenses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (!strlen($year) == 4){
            Yii::$app->session->setFlash('error', 'Select the year for the Items first.');
            return $this->render('select-year', [
                'msg' => 'select year'
            ]);
        }else {
            if(!$fundyearData = FundItems::findOne(['year' => $year])){
                Yii::$app->session->setFlash('error', 'No Fund Items for the Year '.$year.'. Go and Add Fund Items First .');
                return $this->render('select-year', [
                    'msg' => 'select year'
                ]);
            }

        }

        $model = new IncomesAndExpenses();
        $user = Yii::$app->user->id;
        $post_model = Yii::$app->request->post();
        if ($model->load($post_model) ) {

            if (User::userIsAllowedTo('Manage Department')) {
                $dept = Yii::$app->session['department'];
                $fund_item = $model->fund_item;
                if(!$isvalidItemDepartment = FundItems::findOne(['id' => $fund_item, 'dept'=> $dept])){
                    Yii::$app->session->setFlash('error', 'The selected item does not belong to your department.');
                    return $this->render('create', [
                        'model' => $model,
                        'year' => $year
                    ]);
                }
            }

            $model->added_by = $user;
            $model->date_of_trans = strtotime($model->date_of_trans);

            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            

        }


        return $this->render('create', [
            'model' => $model,
            'year' => $year
        ]);
    }

    /**
     * Updates an existing IncomesAndExpenses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $receipt_fund_item = $model->fund_item;
        $year = FundItems::findOne(['id' => $receipt_fund_item])->year;
        Yii::$app->session->setFlash('success', 'Editing an entry for the year: '.$year.'.');
        
        $user = Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) ) {
            $model->added_by = $user;
            $model->date_of_trans = strtotime($model->date_of_trans);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'year' => $year,

        ]);
    }

    /**
     * Deletes an existing IncomesAndExpenses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the IncomesAndExpenses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return IncomesAndExpenses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = IncomesAndExpenses::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}