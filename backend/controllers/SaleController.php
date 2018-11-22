<?php

namespace backend\controllers;

use Yii;
use backend\models\Sale;
use backend\models\SaleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
//    public function actionFinditemfull(){
//        $txt = \Yii::$app->request->post('txt');
//        $list = [];
//        if($txt == ''){
//            $model = \backend\models\Product::find()
//                ->asArray()
//                ->all();
//            return Json::encode($model);
//            //return 'no';
//        }else{
//            $list = [];
//            $maxprice = 0;
//            $model = \backend\models\Product::find()->where(['product_code'=>$txt])->one();
//            if($model){
//                $model_max_price = \backend\models\Productstockprice::find()->where(['product_id'=>$model->id])->orderBy(['price'=>SORT_DESC])->one();
//                if($model_max_price){
//                    $maxprice = $model_max_price->price;
//                }
//                array_push($list,['product_id'=>$model->id,'name'=>$model->name,'maxprice'=>$maxprice]);
//            }
//            return Json::encode($list);
//        }
//
//    }
}
