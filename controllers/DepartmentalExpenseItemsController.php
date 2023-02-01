<?php

namespace app\controllers;

use Yii;
use app\models\DepartmentalExpenseItems;
use app\models\DepartmentalExpenseItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\FundItems;
use app\models\User;
/**
 * DepartmentalExpenseItemsController implements the CRUD actions for DepartmentalExpenseItems model.
 */
class DepartmentalExpenseItemsController extends Controller
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
        if (!User::userIsAllowedTo('Manage Users')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['home/index']);
		}
        return parent::beforeAction($action);
    }
    /**
     * Lists all DepartmentalExpenseItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (!strlen($year) == 4){
            $year = date('Y');
        }
        $searchModel = new DepartmentalExpenseItemsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$year);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
    }

    /**
     * Displays a single DepartmentalExpenseItems model.
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
     * Creates a new DepartmentalExpenseItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DepartmentalExpenseItems();

        if ($model->load(Yii::$app->request->post())) {
            $fund_item_id = $model->fund_item;
            $fund_model = FundItems::findOne($fund_item_id);
            $year = $fund_model->year;
            $existing_model = DepartmentalExpenseItems::find()->where(['fund_item'=>$fund_item_id])->andWhere([ 'year'=>$year])->all();
            if($existing_model != null){
                Yii::$app->session->setFlash('error', 'Item already exists as a Departmental Expense.');
            } else {
                $model->year = $year;
                if ( $model->save()) {
                    Yii::$app->session->setFlash('success', 'Item added as a Departmental Expense.');
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DepartmentalExpenseItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

                $fund_item_id = $model->id;
                $fund_model = FundItems::findOne($fund_item_id);
                $year = $fund_model->year;
                $model->year = $year;
                if ( $model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            

        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DepartmentalExpenseItems model.
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
     * Finds the DepartmentalExpenseItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DepartmentalExpenseItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DepartmentalExpenseItems::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}