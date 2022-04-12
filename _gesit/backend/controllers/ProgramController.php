<?php

namespace backend\controllers;
use Yii;
use yii\web\UploadedFile;
use mdm\autonumber\AutoNumber;
use backend\models\ProgramDonasi;
use backend\models\BannerDonasi;
use backend\models\ProgramDonasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProgramController implements the CRUD actions for ProgramDonasi model.
 */
class ProgramController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all ProgramDonasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProgramDonasiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProgramDonasi model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProgramDonasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ProgramDonasi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProgramDonasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ProgramDonasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionAddbanner()
    {
        $model = new BannerDonasi();
        $pelatihanid = $_GET['pelatihanid'];
        $idx = $_GET['id'];
        $model->program_id = $idx;
        $model->timecreated =  date('Y-m-d H:i:s');
        $model->banner_id =  time();
        if ($model->load(Yii::$app->request->post())) {
            $model->banner = UploadedFile::getInstance($model,'banner');
            if($model->banner){               
                $file =$model->banner_id.'.'.$model->banner->extension;
                if ($model->banner->saveAs(Yii::getAlias('@webroot').'/banner/'.$file)){
                    $model->banner = $file;           
                }
            }
            $model->save(false);
            return $this->redirect(['view','id'=>$idx,'smid'=>$smid]);
        }

        return $this->renderAjax('addbanner', [
            'model' => $model,
        ]);
       
    }

    /**
     * Finds the ProgramDonasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ProgramDonasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProgramDonasi::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
