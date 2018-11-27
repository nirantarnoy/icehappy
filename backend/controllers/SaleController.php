<?php

namespace backend\controllers;

use Yii;
use backend\models\Sale;
use backend\models\SaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Sale model.
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
     * Creates a new Sale model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Sale();

        $modelproduct = \backend\models\Product::find()->limit(5)->all();

        if ($model->load(Yii::$app->request->post())) {
            $cusid = \Yii::$app->request->post('customer_id');

            $model->customer_id = $cusid;
            $model->status = 1;
            $model->trans_date = strtotime(Yii::$app->request->post('trans_date'));
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }

        }

        return $this->render('create', [
            'model' => $model,
            'modelproduct' => $modelproduct
        ]);
    }

    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelproduct = \backend\models\Product::find()->limit(5)->all();
        $modelline = \backend\models\Saleline::find()->where(['sale_id'=>$id])->all();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'modelline'=>$modelline,
            'modelproduct' => $modelproduct
        ]);
    }

    /**
     * Deletes an existing Sale model.
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
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionFinditem(){
        $txt = \Yii::$app->request->post('txt');
        $list = [];
        if($txt == ''){
            return Json::encode($list);
            //return 'no';
        }else{
            $model = \backend\models\Product::find()->where(['Like','product_code',$txt])
                ->orFilterWhere(['like','name',$txt])
                ->asArray()
                ->all();
            return Json::encode($model);
        }

    }
    public function actionFinditemall(){
        $txt = \Yii::$app->request->post('txt');

        $model = \backend\models\Product::find()
            ->asArray()
            ->all();
        return Json::encode($model);


    }
    public function actionFinditemfull(){
        $txt = \Yii::$app->request->post('txt');
        $list = [];
        if($txt == ''){
            $model = \backend\models\Product::find()
                ->asArray()
                ->all();
            return Json::encode($model);
            //return 'no';
        }else{
            $list = [];
            $customer_price = 0;
            $model = \backend\models\Product::find()->where(['product_code'=>$txt])->one();
            if($model){
                $model_max_price = \backend\models\Customerprice::find()->where(['product_id'=>$model->id])->one();
                if($model_max_price){
                    $customer_price = $model_max_price->price;
                }
                array_push($list,['product_id'=>$model->id,'name'=>$model->name,'customer_price'=>$customer_price]);
            }
            return Json::encode($list);
        }

    }
    public function actionFindcustomerprice(){
        $id = \Yii::$app->request->post("prodid");
        $cust_id = \Yii::$app->request->post("custid");
        // return $id;
        $list = [];
        if($id){

            $model = \backend\models\Customerdetail::find()->where(['itemid'=>$id,'customer_id'=>$cust_id])->one();
            if($model){
                array_push($list,['price'=>$model->line_price]);
                return $list;
            }
            return $list;
        }
        return $list;
    }
    public function actionFindrunno(){
        $cusid = Yii::$app->request->post('cusid');
        $runno = '';
        if($cusid){
            $runno = \backend\models\Sale::getLastNo($cusid);
        }
        return $runno;
    }
    public function actionPrint($id){
        $sale_id = $id;
        $papersize = Yii::$app->request->post('paper_size');
        $papersize = 2;
       // echo 'niran'.$id;return;
        $model = \backend\models\Sale::find()->where(['id'=>$sale_id])->one();
        if($model){
           // echo "niran";return;
            $pdf = new Pdf([

                //'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                //  'format' => [150,236], //manaul
                'mode'=> 's',
                'format' => $papersize ==1? Pdf::FORMAT_A4:[150,236],
                'orientation' => $papersize ==1?Pdf::ORIENT_PORTRAIT:Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER,
                'content' => $this->renderPartial('_print',[
                    'model'=>$model
                ]),
                //'content' => "nira",
                //'defaultFont' => '@backend/web/fonts/config.php',
                'cssFile' => '@backend/web/css/pdf.css',
                //'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                'options' => [
                    'title' => 'รายงานระหัสินค้า',
                    'subject' => ''
                ],
                'methods' => [
                    //  'SetHeader' => ['รายงานรหัสสินค้า||Generated On: ' . date("r")],
                    //  'SetFooter' => ['|Page {PAGENO}|'],
                    //'SetFooter'=>'niran',
                ],

            ]);
            //return $this->redirect(['genbill']);
            return $pdf->render();
        }
    }
}
