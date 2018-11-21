<?php

namespace backend\controllers;

use Yii;
use backend\models\Prospect;
use backend\models\ProspectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * ProspectController implements the CRUD actions for Prospect model.
 */
class ProspectController extends Controller
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
        $modelfile = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1])->all();
        $modelseeme = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>3])->all();
        $modelitem = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>1])->all();
        $modelbucket = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>2])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelfile'=>$modelfile,
            'modelseeme'=>$modelseeme,
            'modelitem' => $modelitem,
            'modelbucket' => $modelbucket
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


            $uploadimage = UploadedFile::getInstancesByName('imagefile');




            $item_check = substr(Yii::$app->request->post('select_item'),0,1);
            $item_last = '';
            if($item_check == ","){
                $item_last= substr(Yii::$app->request->post('select_item'),1,strlen(Yii::$app->request->post('select_item')));
            }else{
                $item_last = Yii::$app->request->post('select_item');
            }
            $item_list = explode(',',$item_last) ;
            $item_qty = Yii::$app->request->post('item_qty');

            $bucket_check = substr(Yii::$app->request->post('select_bucket'),0,1);
            $bucket_last = '';

            if($bucket_check == ","){
                $bucket_last= substr(Yii::$app->request->post('select_bucket'),1,strlen(Yii::$app->request->post('select_bucket')));
            }else{
                $bucket_last = Yii::$app->request->post('select_bucket');
            }

            $bucket_list = explode(',',$bucket_last) ;
            $bucket_qty = Yii::$app->request->post('bucket_qty');

            $seeme = Yii::$app->request->post('seeme');

            $model->status=1;
//            print_r($seeme);
//            return;
            if($model->save()){
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){


                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        Image::thumbnail(Yii::getAlias('@backend') .'/web/uploads/images/'.$file, 100, 70)
                            ->rotate(0)
                            ->save(Yii::getAlias('@backend') .'/web/uploads/thumbnail/'.$file, ['jpeg_quality' => 100]);


                        $modelfile = new \common\models\CustomerFile();
                        $modelfile->party_id = $model->id;
                        $modelfile->party_type = 1; //1 = คัดกรอง
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }

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
                if(count($seeme)>0){
                    for($i=0;$i<=count($seeme)-1;$i++){

                        $detail = new \backend\models\Prospectdetail();
                        $detail->prospect_id = $model->id;
                        $detail->itemid = $seeme[$i];
                       // $detail->qty = $bucket_qty[$i];
                        $detail->line_type = 3;
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
        $seeme_select = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>3])->all();
        $modelfile = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1])->all();
        if ($model->load(Yii::$app->request->post())) {
            $uploadimage = UploadedFile::getInstancesByName('imagefile');

            $item_check = substr(Yii::$app->request->post('select_item'),0,1);
            $item_last = '';
            if($item_check == ","){
                $item_last= substr(Yii::$app->request->post('select_item'),1,strlen(Yii::$app->request->post('select_item')));
            }else{
                $item_last = Yii::$app->request->post('select_item');
            }
            $item_list = explode(',',$item_last) ;
            $item_qty = Yii::$app->request->post('item_qty');

            $bucket_check = substr(Yii::$app->request->post('select_bucket'),0,1);
            $bucket_last = '';
            if($bucket_check == ","){
                $bucket_last= substr(Yii::$app->request->post('select_bucket'),1,strlen(Yii::$app->request->post('select_bucket')));
            }else{
                $bucket_last = Yii::$app->request->post('select_bucket');
            }
            $bucket_list = explode(',',$bucket_last) ;
            $bucket_qty = Yii::$app->request->post('bucket_qty');

            $seeme = Yii::$app->request->post('seeme');

          //  print_r($item_list);return;
            if($model->save()){
                if(!empty($uploadimage)){
                    foreach($uploadimage as $file){


                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/images/'.$file);
                        Image::thumbnail(Yii::getAlias('@backend') .'/web/uploads/images/'.$file, 100, 70)
                            ->rotate(0)
                            ->save(Yii::getAlias('@backend') .'/web/uploads/thumbnail/'.$file, ['jpeg_quality' => 100]);


                        $modelfile = new \common\models\CustomerFile();
                        $modelfile->party_id = $model->id;
                        $modelfile->party_type = 1; //1 = คัดกรอง
                        $modelfile->file_type = 2; // 2 = รูปภาพ
                        $modelfile->name = $file;
                        $modelfile->save(false);
                    }
                }

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

                }
                if(count($bucket_list)>0){

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
                if(count($seeme)>0){
                    \backend\models\Prospectdetail::deleteAll(['prospect_id'=>$id,'line_type'=>3]);
                    for($i=0;$i<=count($seeme)-1;$i++){

                        $detail = new \backend\models\Prospectdetail();
                        $detail->prospect_id = $model->id;
                        $detail->itemid = $seeme[$i];
                        // $detail->qty = $bucket_qty[$i];
                        $detail->line_type = 3;
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
            'bucket' => $bucket,
            'seeme'=> $seeme_select,
            'modelfile' => $modelfile,
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
        if($this->findModel($id)->delete()){

            $modelfile = \common\models\CustomerFile::find()->where(['party_id'=>$id])->all();
            if($modelfile){
                foreach ($modelfile as $val){

                        if(file_exists(Yii::getAlias('@backend') .'/web/uploads/images/'.$val->name)){
                            unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$val->name);
                        }
                        if(file_exists(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$val->name)){
                            unlink(Yii::getAlias('@backend') .'/web/uploads/thumpnail/'.$val->name);
                        }

                }
            }


            $session = Yii::$app->session;
            $session->setFlash('msg','ลบรายการเรียบร้อย');
            return $this->redirect(['index']);
        }
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
    public function actionDeletepic(){
        //$id = \Yii::$app->request->post("product_id");
        $picid = \Yii::$app->request->post("pic_id");
        if($picid){
            $model = \common\models\CustomerFile::find()->where(['id'=>$picid])->one();
            if($model){

                if(\common\models\CustomerFile::deleteAll(['id'=>$picid])){
                    unlink(Yii::getAlias('@backend') .'/web/uploads/images/'.$model->name);
                    unlink(Yii::getAlias('@backend') .'/web/uploads/thumbnail/'.$model->name);
                }
            }

            return true;
        }
    }
}
