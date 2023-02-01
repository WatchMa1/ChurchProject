<?php

namespace app\controllers;

use Yii;
use app\models\UserSignatures;
use app\models\UserSignaturesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use MP\SelectModel\MPModelSelectAction;
use app\models\User;
/**
 * UserSignaturesController implements the CRUD actions for UserSignatures model.
 */
class UserSignaturesController extends Controller
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
     * Lists all UserSignatures models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $user = Yii::$app->user->id;
        if($model = UserSignatures::findOne(['user_id'=>$user])){
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You need to first add a Signature.');
            return $this->redirect(['create']);
        }
    }

    /**
     * Displays a single UserSignatures model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $user = Yii::$app->user->id;
        if($model = UserSignatures::findOne(['user_id'=>$user])){
            return $this->render('view', [
                'model' => $model,
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'You need to first add a Signature.');
            return $this->redirect(['create']);
        }
    }

    /**
     * Creates a new UserSignatures model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $user = Yii::$app->user->id;
        if($model = UserSignatures::findOne(['user_id'=>$user])){
            return $this->redirect(['view']);
        }
        $model = new UserSignatures();
        if ($model->load(Yii::$app->request->post())) {
            $file = UploadedFile::getInstance($model, 'signature');
            if (empty($file)) {
                Yii::$app->session->setFlash('error', 'No file submited. Select a file and submit.');
            } else { 
                $filename = 'signature_'  .$user. rand(5,10) . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                $model->user_id = Yii::$app->user->id;
                $model->signature = $filename;
                $file->saveAs('uploads/user_signature/' . $filename);
                if ($model->save()) {
                    return $this->redirect(['view']);
                } else {
                    Yii::$app->session->setFlash('error', 'Failed to save.');
                }
            } 
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserSignatures model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $user = Yii::$app->user->id;
        if($model = UserSignatures::findOne(['user_id'=>$user])){
            $old_signature = $model->signature;
            if ($model->load(Yii::$app->request->post())) {
                $file = UploadedFile::getInstance($model, 'signature');
                if (empty($file)) {
                    Yii::$app->session->setFlash('error', 'No file submited. Select a file and submit.');
                } else { 
                    $filename = 'signature_' . $user.rand(5,10) . '_' . date("d-m-Y_h-i-s") . '.' . $file->extension;
                    $model->user_id = Yii::$app->user->id;
                    $model->signature = $filename;

                    if($file->saveAs('uploads/user_signature/' . $filename)){
                        if ($model->save()) {
                            $old_file = 'uploads/user_signature/'.$old_signature;
                            if(file_exists($old_file)){
                                unlink($old_file);
                            }
                            return $this->redirect(['view', 'id' => $model->id]);
                        }

                    } else {
                        Yii::$app->session->setFlash('error', 'Failed to upload file. Retry.');

                    }
                } 
            }
            return $this->render('update', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'First add a Signature.');
        return $this->redirect(['create']);        

    }

    /**
     * Deletes an existing UserSignatures model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        if(Yii::$app->user->isGuest){
			return $this->goHome();
		}
        $user = Yii::$app->user->id;
        if($model = UserSignatures::findOne(['user_id'=>$user])){
            $id = $model->id;
            $old_signature = $model->signature;

            if($this->findModel($id)->delete()){
                Yii::$app->session->setFlash('success', 'Signature Deleted.');
                $old_file = 'uploads/user_signature/'.$old_signature;
                if(file_exists($old_file)){
                    unlink($old_file);
                }
            }

        } else {
            Yii::$app->session->setFlash('error', 'No Signature Found.');

        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the UserSignatures model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserSignatures the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserSignatures::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}