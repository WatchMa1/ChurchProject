<?php

namespace app\controllers;

use Yii;
use app\models\WeddingNotices;
use app\models\WeddingNoticesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\User;

/**
 * WeddingNoticesController implements the CRUD actions for WeddingNotices model.
 */
class WeddingNoticesController extends Controller
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
			return $this->goHome();
		}
        return parent::beforeAction($action);
    }
    /**
     * Lists all WeddingNotices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WeddingNoticesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeddingNotices model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user = Yii::$app->user->id;
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
            $model = $this->findModel($id);
        } else {
            $model = $this->findModel(['added_by' => $user,'id' => $id]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new WeddingNotices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new WeddingNotices();

        if ($model->load(Yii::$app->request->post())) {
            $user = Yii::$app->user->id;
            $model->added_by = $user;
            $model->wedding_date = strtotime($model->wedding_date);
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeddingNotices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateState($id)
    {
        if (User::userIsAllowedTo('Manage Users') || User::userIsAllowedTo('Church Minister')) {
            $model = $this->findModel($id);
            if ($model->load(Yii::$app->request->post())) {
                $user = Yii::$app->user->id;
                $model->processed_by = $user;
                $model->processed_at = time();
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->render('update-state', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
        return $this->redirect(['home/index']);
    }


    /**
     * Deletes an existing WeddingNotices model.
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
     * Finds the WeddingNotices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeddingNotices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeddingNotices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}