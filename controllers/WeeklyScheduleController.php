<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\WeeklySchedule;
use app\models\WeeklyScheduleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use MP\SelectModel\MPModelSelectAction;
use kartik\mpdf\Pdf;
/**
 * WeeklyScheduleController implements the CRUD actions for WeeklySchedule model.
 */
class WeeklyScheduleController extends Controller
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
     * Lists all WeeklySchedule models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $searchModel = new WeeklyScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    
    }
    /**
     * Lists all WeeklySchedule models.
     * @return mixed
     */
    public function actionAnnouncements()
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $searchModel = new WeeklyScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('announcements', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all WeeklySchedule models.
     * @return mixed
     */
    public function actionBulletins()
    
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $searchModel = new WeeklyScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bulletins', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionWeeklyBulletins()
    {
        $searchModel = new WeeklyScheduleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('bulletin-list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single WeeklySchedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single WeeklySchedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewAnnouncement($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        return $this->render('view-announcement', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Displays a single WeeklySchedule model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewBulletin($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        return $this->render('view-bulletin', [
            'model' => $this->findModel($id),
        ]);
    }

        /**
     * Downloads a single WeeklySchedule model entry as pdf.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownloadBulletin($id)
    {
         return $this->renderPartial('download-bulletin2', [
            'model' => $this->findModel($id),
        ]);
    }
    

    /**
     * Creates a new WeeklySchedule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $model = new WeeklySchedule();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing WeeklySchedule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionUpdateAnnouncement($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-announcement', 'id' => $model->id]);
        }

        return $this->render('update-announcement', [
            'model' => $model,
        ]);
    }

    public function actionUpdateBulletin($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view-bulletin', 'id' => $model->id]);
        }

        return $this->render('update-bulletin', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing WeeklySchedule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!User::userIsAllowedTo('Manage Users') && !User::userIsAllowedTo('Church Minister')) {
            Yii::$app->session->setFlash('error', 'You are not authorised to perform that action.');
            return $this->redirect(['weekly-schedule/weekly-bulletins']);
		}
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the WeeklySchedule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return WeeklySchedule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = WeeklySchedule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}