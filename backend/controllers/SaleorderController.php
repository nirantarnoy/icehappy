<?php

namespace backend\controllers;

use Yii;
use backend\models\Saleorder;
use backend\models\SaleorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * SaleorderController implements the CRUD actions for Saleorder model.
 */
class SaleorderController extends Controller
{
    public $enableCsrfValidation = false;
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

    /**
     * Lists all Saleorder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleorderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Saleorder model.
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
     * Creates a new Saleorder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Saleorder();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Saleorder model.
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

    /**
     * Deletes an existing Saleorder model.
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
     * Finds the Saleorder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Saleorder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Saleorder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionFindzone(){
        $id = Yii::$app->request->post('id');
        $list = [];
        if($id){
            $model = \backend\models\Salezone::find()->where(['id'=>$id])->one();
            if($model){
                $model_cus = \backend\models\Custumer::find()->where(['zone_id'=>$id])->all();
                if($model_cus){
                    foreach($model_cus as $value){
                        array_push($list,['zone_name'=>$model->description,'cus_code'=>$value->code,'cus_id'=>$value->id,'cus_name'=>$value->first_name." ".$value->last_name]);
                    }
                }
                return Json::encode($list);
            }else{
                return Json::encode($list);
            }
        }
        return Json::encode($list);
    }
    public function actionFindrunno(){
        $zoneid = Yii::$app->request->post('zoneid');
        $runno = '';
        if($zoneid){
            $runno = \backend\models\Sale::getLastNo($zoneid);
        }
        return $runno;
    }
}
