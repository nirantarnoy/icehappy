<?php

namespace backend\controllers;

use Yii;
use backend\models\Saleorder;
use backend\models\SaleorderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use kartik\mpdf\Pdf;

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
                    'delete' => ['POST','GET'],
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

        if ($model->load(Yii::$app->request->post())) {

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'runno' => $model::getLastNo(),
        ]);
    }
    public function actionCreateorder(){

        $saleno = Yii::$app->request->post('sale_no');
        $salezone = Yii::$app->request->post('sale_zone');
        $saledate = Yii::$app->request->post('sale_date');


        $cusid = Yii::$app->request->post('cus_id');

        $prod1_qty = Yii::$app->request->post('product1-qty');
        $prod2_qty = Yii::$app->request->post('product2-qty');
        $prod3_qty = Yii::$app->request->post('product3-qty');
        $prod4_qty = Yii::$app->request->post('product4-qty');

        $prod1_prc = Yii::$app->request->post('product1-price');
        $prod2_prc = Yii::$app->request->post('product2-price');
        $prod3_prc = Yii::$app->request->post('product3-price');
        $prod4_prc = Yii::$app->request->post('product4-price');

        $prod1_total = Yii::$app->request->post('product1-total');
        $prod2_total = Yii::$app->request->post('product2-total');
        $prod3_total = Yii::$app->request->post('product3-total');
        $prod4_total = Yii::$app->request->post('product4-total');

        $free1_qty = Yii::$app->request->post('free1-qty');
        $free2_qty = Yii::$app->request->post('free2-qty');

        $free1_total = Yii::$app->request->post('free1-total');
        $free2_total = Yii::$app->request->post('free2-total');


       // print_r($prod1_qty);return;
        //echo $saleno;return;
        if($saleno !='' && $salezone !=''){
          //  echo 'niran';return;
            $model = new \backend\models\Saleorder();
            $model->sale_no = $saleno;
            $model->sale_date = $saledate;
            $model->sale_zone = $salezone;
            $model->status = 1;
            if($model->save(false)){
                if(count($cusid) && count($prod1_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod1_qty[$i] == '' || $prod1_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod1_qty[$i];
                        $modelline->price = $prod1_prc[$i];
                        $modelline->product_id = 1;
                      //  $modelline->free_qty = $free1_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod2_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod2_qty[$i] == '' || $prod2_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod2_qty[$i];
                        $modelline->price = $prod2_prc[$i];
                        $modelline->product_id = 2;
                      //  $modelline->free_qty = $free2_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod3_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod3_qty[$i] == '' || $prod3_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod3_qty[$i];
                        $modelline->price = $prod3_prc[$i];
                        $modelline->product_id = 3;
                       // $modelline->free_qty = $free3_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod4_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod4_qty[$i] == '' || $prod4_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod4_qty[$i];
                        $modelline->price = $prod4_prc[$i];
                        $modelline->product_id = 4;
                        // $modelline->free_qty = $free3_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($free1_qty[$i]=='' && $free2_qty[$i] == ''){continue;}
                        $modelfree = new \backend\models\Salefree();
                        $modelfree->customer_id = $cusid[$i];
                        $modelfree->sale_id = $model->id;
                        $modelfree->qty_big = $free1_qty[$i];
                        $modelfree->qty_small = $free2_qty[$i];
                        //  $modelline->free_qty = $free1_qty[$i];
                        $modelfree->save();

                    }
                }
                return $this->redirect(['index']);
            }
        }
    }

    public function actionUpdateorder(){

        $saleid = Yii::$app->request->post('sale_id');
        $saleno = Yii::$app->request->post('sale_no');
        $salezone = Yii::$app->request->post('sale_zone');
        $saledate = Yii::$app->request->post('sale_date');


        $cusid = Yii::$app->request->post('cus_id');

        $prod1_qty = Yii::$app->request->post('product1-qty');
        $prod2_qty = Yii::$app->request->post('product2-qty');
        $prod3_qty = Yii::$app->request->post('product3-qty');
        $prod4_qty = Yii::$app->request->post('product4-qty');

        $prod1_prc = Yii::$app->request->post('product1-price');
        $prod2_prc = Yii::$app->request->post('product2-price');
        $prod3_prc = Yii::$app->request->post('product3-price');
        $prod4_prc = Yii::$app->request->post('product4-price');

        $prod1_total = Yii::$app->request->post('product1-total');
        $prod2_total = Yii::$app->request->post('product2-total');
        $prod3_total = Yii::$app->request->post('product3-total');
        $prod4_total = Yii::$app->request->post('product4-total');

        $free1_qty = Yii::$app->request->post('free1-qty');
        $free2_qty = Yii::$app->request->post('free2-qty');

        $free1_total = Yii::$app->request->post('free1-total');
        $free2_total = Yii::$app->request->post('free2-total');


        // print_r($prod1_qty);return;
        //echo $saleno;return;
        if($saleno !='' && $salezone !=''){
            //  echo 'niran';return;
            $model = \backend\models\Saleorder::find()->where(['id'=>$saleid])->one();
            $model->sale_no = $saleno;
            $model->sale_date = $saledate;
            $model->sale_zone = $salezone;
            $model->status = 1;
            if($model->save(false)){
                \backend\models\Saleorderline::deleteAll(['sale_id'=>$saleid]);
                if(count($cusid) && count($prod1_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod1_qty[$i] == '' || $prod1_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod1_qty[$i];
                        $modelline->price = $prod1_prc[$i];
                        $modelline->product_id = 1;
                        //  $modelline->free_qty = $free1_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod2_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod2_qty[$i] == '' || $prod2_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod2_qty[$i];
                        $modelline->price = $prod2_prc[$i];
                        $modelline->product_id = 2;
                        //  $modelline->free_qty = $free2_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod3_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod3_qty[$i] == '' || $prod3_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod3_qty[$i];
                        $modelline->price = $prod3_prc[$i];
                        $modelline->product_id = 3;
                        // $modelline->free_qty = $free3_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid) && count($prod4_qty)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($prod4_qty[$i] == '' || $prod4_qty[$i]<=0){continue;}
                        $modelline = new \backend\models\Saleorderline();
                        $modelline->customer_id = $cusid[$i];
                        $modelline->sale_id = $model->id;
                        $modelline->qty = $prod4_qty[$i];
                        $modelline->price = $prod4_prc[$i];
                        $modelline->product_id = 4;
                        // $modelline->free_qty = $free3_qty[$i];
                        $modelline->save();

                    }
                }
                if(count($cusid)){
                    for($i=0;$i<=count($cusid)-1;$i++){
                        if($free1_qty[$i]=='' && $free2_qty[$i] == ''){continue;}
                        $modelfree = new \backend\models\Salefree();
                        $modelfree->customer_id = $cusid[$i];
                        $modelfree->sale_id = $model->id;
                        $modelfree->qty_big = $free1_qty[$i];
                        $modelfree->qty_small = $free2_qty[$i];
                        //  $modelline->free_qty = $free1_qty[$i];
                        $modelfree->save();

                    }
                }
                return $this->redirect(['index']);
            }
        }
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
        $modelline = \backend\models\Saleorderline::find()->where(['sale_id'=>$id])->all();
        $modelfree = \backend\models\Salefree::find()->where(['sale_id'=>$id])->asArray()->all();

        $sql = "
              SELECT  customer_id,code,first_name,last_name, 
                (SELECT qty FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty1,
                (SELECT qty FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty2,
                (SELECT qty FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty3,
                (SELECT qty FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty4,
                (SELECT price FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price1,
                (SELECT price FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price2,
                (SELECT price FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price3,
                (SELECT price FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price4,
                (SELECT qty * price FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total1,
                (SELECT qty * price FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total2,
                (SELECT qty * price FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total3,
                (SELECT qty * price FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total4
            FROM saleorder_line AS t1 
            INNER JOIN customer AS t2 ON t1.customer_id = t2.id
            WHERE t1.sale_id = ".$id."
            GROUP BY customer_id
        ";

        $query = Yii::$app->db->createCommand($sql)->queryAll();



       // print_r($query);return;



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'runno' => $model->sale_no,
            'zone_name' => \backend\models\Salezone::findDescription($model->sale_zone),
            'modelline' => $modelline,
            'query' => $query,
            'modelfree'=>$modelfree

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
        $session = Yii::$app->session;
        $session->setFlash('msg','บันทึกรายการเรียบร้อย');
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
                        $price1 = \backend\models\Custumer::findprice($value->id,1);
                        $price2 = \backend\models\Custumer::findprice($value->id,2);
                        $price3 = \backend\models\Custumer::findprice($value->id,3);
                        $price4 = \backend\models\Custumer::findprice($value->id,4);
                        array_push($list,['zone_name'=>$model->description,'cus_code'=>$value->code,
                                                 'cus_id'=>$value->id,'cus_name'=>$value->first_name." ".$value->last_name,
                                'price1'=>$price1,
                                'price2'=>$price2,
                                'price3'=>$price3,
                                'price4'=>$price4,
                            ]
                                  );
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
    public function actionPrint($id){
        $sale_id = $id;
        $papersize = Yii::$app->request->post('paper_size');
        $papersize = 1;
        // echo 'niran'.$id;return;
        //$model = \backend\models\Saleorder::find()->where(['id'=>$sale_id])->one();

        $sql_sale = "
            select *,sale_zone.name as zone_code,sale_zone.description as zone_description
            from saleorder
            INNER JOIN 
            sale_zone on sale_zone.id = saleorder.sale_zone
            WHERE saleorder.id =".$sale_id."
        ";

        $query_sale = Yii::$app->db->createCommand($sql_sale)->queryAll();
        $modelfree = \backend\models\Salefree::find()->where(['sale_id'=>$sale_id])->asArray()->all();

        if(count($query_sale)>0){
            $sql = "
              SELECT  customer_id,code,first_name,last_name, 
                    (SELECT qty FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty1,
                    (SELECT qty FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty2,
                    (SELECT qty FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty3,
                    (SELECT qty FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS qty4,
                    (SELECT price FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price1,
                    (SELECT price FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price2,
                    (SELECT price FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price3,
                    (SELECT price FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS price4,
                    (SELECT qty * price FROM saleorder_line WHERE product_id=1 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total1,
                    (SELECT qty * price FROM saleorder_line WHERE product_id=2 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total2,
                    (SELECT qty * price FROM saleorder_line WHERE product_id=3 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total3,
                    (SELECT qty * price FROM saleorder_line WHERE product_id=4 AND customer_id = t1.customer_id AND sale_id = t1.sale_id) AS total4
                FROM saleorder_line AS t1 
                INNER JOIN customer AS t2 ON t1.customer_id = t2.id
                WHERE t1.sale_id = ".$sale_id."
                GROUP BY customer_id
            ";

            $query = Yii::$app->db->createCommand($sql)->queryAll();

            $sql2 = "
                SELECT  sale_id, 
                    (SELECT sum(qty) FROM saleorder_line WHERE product_id=1 AND sale_id = T1.sale_id) AS qty1,
                    (SELECT sum(qty) FROM saleorder_line WHERE product_id=2 AND sale_id = T1.sale_id) AS qty2,
                    (SELECT sum(qty) FROM saleorder_line WHERE product_id=3 AND sale_id = T1.sale_id) AS qty3,
                    (SELECT sum(qty) FROM saleorder_line WHERE product_id=4 AND sale_id = T1.sale_id) AS qty4,
                    (SELECT sum(qty * price) FROM saleorder_line WHERE product_id=1 AND sale_id = T1.sale_id) AS total1,
                    (SELECT sum(qty * price) FROM saleorder_line WHERE product_id=2 AND sale_id = T1.sale_id) AS total2,
                    (SELECT sum(qty * price) FROM saleorder_line WHERE product_id=3 AND sale_id = T1.sale_id) AS total3,
                    (SELECT sum(qty * price) FROM saleorder_line WHERE product_id=4 AND sale_id = T1.sale_id) AS total4
                FROM saleorder_line AS T1 
                WHERE sale_id =".$sale_id."
                GROUP BY sale_id
            ";
            $query2 = Yii::$app->db->createCommand($sql2)->queryAll();

            $sql3 = "
                SELECT  sale_id, 
                    (SELECT sum(qty_big) FROM saleorder_line WHERE product_id=1 AND sale_id = T1.sale_id) AS total_big,
                    (SELECT sum(qty_small) FROM saleorder_line WHERE product_id=2 AND sale_id = T1.sale_id) AS total_small
                FROM sale_free AS T1 
                WHERE sale_id =".$sale_id."
                GROUP BY sale_id
            ";
            $query3 = Yii::$app->db->createCommand($sql3)->queryAll();

            // echo "niran";return;
            $pdf = new Pdf([

                //'mode' => Pdf::MODE_UTF8, // leaner size using standard fonts
                //  'format' => [150,236], //manaul
                'mode'=> 's',
                'format' => $papersize ==1? Pdf::FORMAT_A4:[150,236],
                'orientation' => $papersize ==1?Pdf::ORIENT_PORTRAIT:Pdf::ORIENT_LANDSCAPE,
                'destination' => Pdf::DEST_BROWSER,
                'marginLeft' => 3,
                'marginRight' => 3,
                'content' => $this->renderPartial('_print',[
                    //'model'=>$model,
                    'query'=>$query,
                    'query2'=>$query2,
                    'query3'=>$query3,
                    'query_sale'=>$query_sale,
                    'modelfree'=>$modelfree,
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
    public function actionPrintinvoice(){
        return $this->render('_invoice');
    }
}
