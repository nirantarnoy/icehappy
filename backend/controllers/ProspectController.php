<?php

namespace backend\controllers;

use Yii;
use backend\models\Prospect;
use backend\models\ProspectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProspectController implements the CRUD actions for Prospect model.
 */
class ProspectController extends Controller
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

    /**
     * Lists all Prospect models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProspectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Prospect model.
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
     * Creates a new Prospect model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Prospect();

        if ($model->load(Yii::$app->request->post())) {
            $item_check = substr(Yii::$app->request->post('select_item'),0,1);
            $item_last = '';
            if($item_check == ","){
                $item_last= substr(Yii::$app->request->post('select_item'),1,strlen(Yii::$app->request->post('select_item')));
            }
            $item_list = explode(',',$item_last) ;
            $item_qty = Yii::$app->request->post('item_qty');

            $bucket_check = substr(Yii::$app->request->post('select_bucket'),0,1);
            $bucket_last = '';
            if($bucket_check == ","){
                $bucket_last= substr(Yii::$app->request->post('select_bucket'),1,strlen(Yii::$app->request->post('select_bucket')));
            }
            $bucket_list = explode(',',$bucket_last) ;
            $bucket_qty = Yii::$app->request->post('bucket_qty');

            $model->status=1;
//            print_r($item_list);
//            return;
            if($model->save()){
                if(count($item_list)>0 && count($item_qty)>0){
                    for($i=0;$i<=count($item_list)-1;$i++){
                      $detail = new \backend\models\Prospectdetail();
                      $detail->prospect_id = $model->id;
                      $detail->itemid = $item_list[$i];
                      $detail->qty = $item_qty[$i];
                      $detail->line_type = 1;
                      $detail->status = 1;
                      $detail->save();
                    }

                }
                if(count($bucket_list)>0 && count($bucket_qty)>0){
                    for($i=0;$i<=count($bucket_list)-1;$i++){

                        $detail = new \backend\models\Prospectdetail();
                        $detail->prospect_id = $model->id;
                        $detail->itemid = $bucket_list[$i];
                        $detail->qty = $bucket_qty[$i];
                        $detail->line_type = 2;
                        $detail->status = 1;
                        $detail->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Prospect model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $item = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>1])->all();
        $bucket = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>2])->all();

        if ($model->load(Yii::$app->request->post())) {
            $item_check = substr(Yii::$app->request->post('select_item'),0,1);
            $item_last = '';
            if($item_check == ","){
                $item_last= substr(Yii::$app->request->post('select_item'),1,strlen(Yii::$app->request->post('select_item')));
            }
            $item_list = explode(',',$item_last) ;
            $item_qty = Yii::$app->request->post('item_qty');

            $bucket_check = substr(Yii::$app->request->post('select_bucket'),0,1);
            $bucket_last = '';
            if($bucket_check == ","){
                $bucket_last= substr(Yii::$app->request->post('select_bucket'),1,strlen(Yii::$app->request->post('select_bucket')));
            }
            $bucket_list = explode(',',$bucket_last) ;
            $bucket_qty = Yii::$app->request->post('bucket_qty');

           // print_r($bucket_last);return;
            if($model->save()){
                if(count($item_list)>0){
                    \backend\models\Prospectdetail::deleteAll(['prospect_id'=>$id,'line_type'=>1]);
                    for($i=0;$i<=count($item_list)-1;$i++){
                        $detail = new \backend\models\Prospectdetail();
                        $detail->prospect_id = $model->id;
                        $detail->itemid = $item_list[$i];
                        $detail->qty = $item_qty[$i];
                        $detail->line_type = 1;
                        $detail->status = 1;
                        $detail->save();
                    }
                    \backend\models\Prospectdetail::deleteAll(['prospect_id'=>$id,'line_type'=>2]);
                    for($i=0;$i<=count($bucket_list)-1;$i++){

                        $detail = new \backend\models\Prospectdetail();
                        $detail->prospect_id = $model->id;
                        $detail->itemid = $bucket_list[$i];
                        $detail->qty = $bucket_qty[$i];
                        $detail->line_type = 2;
                        $detail->status = 1;
                        $detail->save();
                    }
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'item' => $item,
            'bucket' => $bucket
        ]);
    }

    /**
     * Deletes an existing Prospect model.
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
     * Finds the Prospect model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Prospect the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Prospect::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
