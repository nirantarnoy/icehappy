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
        $modelfile = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1,'file_type'=>2])->all();
        $modeldoc = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1,'file_type'=>3])->all();
        $modelseeme = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>3])->all();
        $modelitem = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>1])->all();
        $modelbucket = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id,'line_type'=>2])->all();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelfile'=>$modelfile,
            'modeldoc'=>$modeldoc,
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

            $prefix = Yii::$app->request->post('prefix');
            $uploadimage = UploadedFile::getInstancesByName('imagefile');
            $uploaddoc = UploadedFile::getInstancesByName('docfile');


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
            $model->zone_id = \Yii::$app->request->post("zone_id");
//            print_r($seeme);
//            return;
            $model->prefix = $prefix;
            if($model->save(false)){
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
                if(!empty($uploaddoc)){
                    foreach($uploaddoc as $file){

                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/documents/'.$file);

                        $modelfile = new \common\models\CustomerFile();
                        $modelfile->party_id = $model->id;
                        $modelfile->party_type = 1; //1 = คัดกรอง
                        $modelfile->file_type = 3; // 2 = รูปภาพ 3 = เอกสาร
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
        $modelfile = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1,'file_type'=>2])->all();
        $modeldoc = \common\models\CustomerFile::find()->where(['party_id'=>$id,'party_type'=>1,'file_type'=>3])->all();
        if ($model->load(Yii::$app->request->post())) {

            $prefix = Yii::$app->request->post('prefix');
            $uploadimage = UploadedFile::getInstancesByName('imagefile');
            $uploaddoc = UploadedFile::getInstancesByName('docfile');

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

            $model->zone_id = \Yii::$app->request->post("zone_id");
            $model->prefix = $prefix;
          //  print_r($item_list);return;
            //echo $prefix;return;
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
                if(!empty($uploaddoc)){
                    foreach($uploaddoc as $file){
                        $file->saveAs(Yii::getAlias('@backend') .'/web/uploads/documents/'.$file);
                        $modelfile = new \common\models\CustomerFile();
                        $modelfile->party_id = $model->id;
                        $modelfile->party_type = 1; //1 = คัดกรอง
                        $modelfile->file_type = 3; // 2 = รูปภาพ 3 = เอกสาร
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
            'modeldoc' => $modeldoc,
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
    public function actionDeletefile(){
        //$id = \Yii::$app->request->post("product_id");
        $filename = trim(\Yii::$app->request->post("file_id"));
        $cusid = \Yii::$app->request->post("cus_id");
        if($filename){
            // return $cusid;
            $model = \common\models\CustomerFile::find()->where(['name'=>$filename,'party_id'=>$cusid,'party_type'=>1])->one();
            if($model){
                //return 100;
                unlink(Yii::getAlias('@backend') .'/web/uploads/documents/'.$filename);
                \common\models\CustomerFile::deleteAll(['party_id'=>$cusid,'name'=>$filename,'party_type'=>1]);
            }

            return true;
        }
    }
    public function actionApprove($id){
        //$id = Yii::$app->request->post('id');
        if($id){
            $model = \backend\models\Prospect::find()->where(['id'=>$id])->one();
            if($model){
                $modelcus = new \backend\models\Custumer();
                $modelcus->code = $modelcus::getLastNo($model->zone_id);
                $modelcus->prefix = $model->prefix;
                $modelcus->first_name = $model->name;
                $modelcus->status = 1;
                $modelcus->lat = $model->lat;
                $modelcus->long = $model->long;
                $modelcus->prefix = $model->prefix;
                $modelcus->first_name = $model->first_name;
                $modelcus->last_name = $model->last_name;
                $modelcus->email = $model->email;
                $modelcus->facebook = $model->facebook;
                $modelcus->line = $model->line;
                $modelcus->zone_id = $model->zone_id;
                $modelcus->prospect_id = $model->id;
                if($modelcus->save()){
                    $model->status = 2;
                    $model->save(false);
                    $modelpro_detail = \backend\models\Prospectdetail::find()->where(['prospect_id'=>$id])->all();
                    if($modelpro_detail){
                        foreach($modelpro_detail as $value){
                            $modelcus_detail = new \backend\models\Customerdetail();
                            $modelcus_detail->customer_id = $modelcus->id;
                            $modelcus_detail->line_type = $value->line_type;
                            $modelcus_detail->qty = $value->qty;
                            $modelcus_detail->itemid = $value->itemid;
                            $modelcus_detail->status = $value->status;
                            $modelcus_detail->save(false);

                        }
                    }
                    $modelpro_image = \common\models\CustomerFile::find()->where(['party_type'=>1,'party_id'=>$id,'file_type'=>2])->all();
                    if($modelpro_image){
                        foreach($modelpro_image as $value){
                            $modelfile = new \common\models\CustomerFile();
                            $modelfile->party_id = $modelcus->id;
                            $modelfile->party_type = 2; //2 = ลูกค้า
                            $modelfile->file_type = 2; // 2 = รูปภาพ
                            $modelfile->name = $value->name;
                            $modelfile->save(false);
                        }
                    }
                    $modelpro_doc = \common\models\CustomerFile::find()->where(['party_type'=>1,'party_id'=>$id,'file_type'=>3])->all();
                    if($modelpro_doc){
                        foreach($modelpro_doc as $value){
                            $modelfile = new \common\models\CustomerFile();
                            $modelfile->party_id = $modelcus->id;
                            $modelfile->party_type = 2; //2 = ลูกค้า
                            $modelfile->file_type = 3; // 3 = เอกสาร
                            $modelfile->name = $value->name;
                            $modelfile->save(false);
                        }
                    }
                    $this->redirect(['customer/view','id'=>$modelcus->id]);
                }
            }

        }
    }
    public function actionMap(){
      //  $contacts = Contact::find()->all();
        $contacts = null;
        return $this->render('_map',['contacts'=>$contacts]);
    }
}
