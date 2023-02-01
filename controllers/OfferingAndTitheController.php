<?php

namespace app\controllers;

use Yii;
use app\models\OfferingAndTithe;
use app\models\OfferingAndTitheSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OfferingAndTitheReceipts;
use app\models\FundItems;
use app\models\User;
use MP\SelectModel\MPModelSelectAction;

/**
 * OfferingAndTitheController implements the CRUD actions for OfferingAndTithe model.
 */
class OfferingAndTitheController extends Controller
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
    public function actions(): array
    {
        return array_merge(parent::actions(), [
            'model-search' => [
                'class' => MPModelSelectAction::class,
            ],
        ]);
    }
    /**
     * Lists all OfferingAndTithe models.
     * @return mixed
     */
    public function actionIndex()
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
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'year' => $year,
        ]);
    }

    /**
     * Displays a single OfferingAndTithe model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $receipt_id = $model->receipt_id;
        $receipt_fund_item = OfferingAndTitheReceipts::findOne(['receipt_id'=>$receipt_id])->fund_item;
        $year = FundItems::findOne(['id' => $receipt_fund_item])->year;
        Yii::$app->session->setFlash('success', 'Viewing one entry from the year: '.$year.'.');
        return $this->render('view', [
            'model' => $model,
            'year' => $year,
        ]);
    }

    /**
     * Creates a new OfferingAndTithe model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OfferingAndTithe();
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
        } else {
            $year = date('Y');
        }
        Yii::$app->session->setFlash('success', 'Creating an entry for the year: '.$year.'.');
        
        if ($model->load(Yii::$app->request->post())) {
            $user = Yii::$app->user->id;
            $model->added_by = $user;
            $model->updated_by = $user;
            $model->date_of_receipt = strtotime($model->date_of_receipt);
            $date_of_receipt =  $model->date_of_receipt;

            $min = $year.'-01-01';
            $min =  strtotime($min);
            $max = $year.'-12-31';
            $max =  strtotime($max);
            if (($date_of_receipt >= $min) && ($date_of_receipt <= $max)) {
                $fund_items = FundItems::find(['year' => $year])->asArray()->all();
                $num_of_fund_items = count($fund_items);
                if ($num_of_fund_items == 0) {
                    Yii::$app->session->setFlash('error', 'There are no Fund Items that exist for the year: '.$year.'. Add fund Items First.');
                } else {
                    if($model->save()){
                        $receipt_id = $model->receipt_id;
                        $postData = Yii::$app->request->post();
                        for ($i=0; $i < $num_of_fund_items; $i++) { 
                            $curRow = $fund_items[$i];
                            $item_id = $curRow['id'];
                            $amount = (isset($postData['receipts']['fund-'.$item_id])) ? $postData['receipts']['fund-'.$item_id] : 0;
                            $receipt_model = new OfferingAndTitheReceipts();
                            $receipt_model->receipt_id = $receipt_id;
                            $receipt_model->fund_item = $item_id;
                            $receipt_model->amount = $amount;
                            $receipt_model->added_by = $user;
                            $receipt_model->updated_by = $user;
        
                            $receipt_model->save();
        
                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }


                    

            } else {
                Yii::$app->session->setFlash('error', 'Failed to Save! Selected date of receipt is out of the range for the year: '.$year.'.');
            }
        }

        return $this->render('create', [
            'model' => $model,
            'year' => $year,
        ]);
    }

    /**
     * Updates an existing OfferingAndTithe model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $receipt_id_old = $model->receipt_id;
        $receipt_fund_item = OfferingAndTitheReceipts::findOne(['receipt_id'=>$receipt_id_old])->fund_item;
        $year = FundItems::findOne(['id' => $receipt_fund_item])->year;
        Yii::$app->session->setFlash('success', 'Editing an entry for the year: '.$year.'.');
        

        if ($model->load(Yii::$app->request->post())) {
            $user = Yii::$app->user->id;
            $model->updated_by = $user;
            $model->date_of_receipt = strtotime($model->date_of_receipt);
            $date_of_receipt = $model->date_of_receipt;
            $min = $year.'-01-01';
            $min =  strtotime($min);
            $max = $year.'-12-31';
            $max =  strtotime($max);
            if (($date_of_receipt >= $min) && ($date_of_receipt <= $max)) {
                $fund_items = FundItems::find(['year' => $year])->asArray()->all();
                $num_of_fund_items = count($fund_items);
                if ($num_of_fund_items == 0) {
                    Yii::$app->session->setFlash('error', 'There are no Fund Items that exist for the year: '.$year.'. Add fund Items First.');
                } else {
                    if($model->save()){
                        $receipt_id = $model->receipt_id;
                        $postData = Yii::$app->request->post();
                        $fund_items = FundItems::find()->asArray()->all();
                        $num_of_fund_items = count($fund_items);
                        for ($i=0; $i < $num_of_fund_items; $i++) { 
                            $curRow = $fund_items[$i];
                            $item_id = $curRow['id'];
                            $amount = (isset($postData['receipts']['fund-'.$item_id])) ? $postData['receipts']['fund-'.$item_id] : 0;
                            if ($receipt_model = OfferingAndTitheReceipts::findOne(['receipt_id'=>$receipt_id,'fund_item' => $item_id])){
                                $old_amount = $receipt_model->amount;
                            } else {
                                $receipt_model = new OfferingAndTitheReceipts();
                                $receipt_model->receipt_id = $receipt_id;
                                $receipt_model->fund_item = $item_id;
                            }
                            $receipt_model->amount = $amount;
                            $receipt_model->added_by = $user;
                            $receipt_model->updated_by = $user;

                            $receipt_model->save();
                                

                        }
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }
                    
            } else {
                Yii::$app->session->setFlash('error', 'Failed to Save! Selected date of receipt is out of the range for the year: '.$year.'.');
            }
        }
        return $this->render('update', [
            'model' => $model,
            'year' => $year,
        ]);
    }

    /**
     * Deletes an existing OfferingAndTithe model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $year = Yii::$app->getRequest()->getQueryParam('year');
        if (strlen(intval($year)) == 4){
        } else {
            $year = date('Y');
        }
        $this->findModel(['receipt_id'=>$id])->delete();
        $receipt_model = OfferingAndTitheReceipts::findOne(['receipt_id'=>$id]);
        return $this->redirect(['index?year='.$year]);
    }

    /**
     * Finds the OfferingAndTithe model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OfferingAndTithe the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OfferingAndTithe::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}