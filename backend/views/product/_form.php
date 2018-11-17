<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\Url;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model backend\models\Product */
/* @var $form yii\widgets\ActiveForm */

//$vendorlist = \backend\models\Suplier::find()->where(['status'=>1])->all();
?>

<div class="product-form">
    <div class="card">
        <div class="card-body">

<?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left','enctype'=>'multipart/form-data']]); ?>
    <div class="panel panel-headline">
        <div class="panel-heading">
                    <h3><i class="fa fa-cube"></i> <?=$this->title?> <small></small></h3>

                    <div class="clearfix"></div>
                  </div>
                  <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">รหัสสินค้า <span class="required">*</span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                               <?= $form->field($model, 'product_code')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ชื่อสินค้า <span class="required"></span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                               <?= $form->field($model, 'name')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">รายละเอียด <span class="required"></span>
                                            </label>
                                            <div class="col-md-8 col-sm-8 col-xs-12">
                                               <?= $form->field($model, 'description')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                            </div>
                                          </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ต้นทุน <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?= $form->field($model, 'cost')->textInput(['maxlength' => true,'class'=>'form-control','value'=>$model->cost!=""?$model->cost:0])->label(false) ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">สถานะ <span class="required"></span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <?= $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label(false) ?>
                                        </div>
                                    </div>


                                </div>
                                 <div class="col-lg-6">
                                     <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">หมวดสินค้า <span class="required"></span>
                                         </label>
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                             <?= $form->field($model, 'category_id')->widget(Select2::className(),[
                                                 'data' => ArrayHelper::map(backend\models\Productcat::find()->all(),'id','name'),
                                                 'options' => ['placeholder'=>'เลือกกลุ่มสินค้า']
                                             ])->label(false) ?>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">บาร์โค้ด <span class="required"></span>
                                         </label>
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                             <?= $form->field($model, 'barcode')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                                         </div>
                                     </div>
                                     <div class="form-group">
                                         <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">หน่วยนับ <span class="required"></span>
                                         </label>
                                         <div class="col-md-6 col-sm-6 col-xs-12">
                                             <?= $form->field($model, 'unit_id')->widget(Select2::className(),[
                                                 'data' => ArrayHelper::map(backend\models\Unit::find()->all(),'id','name'),
                                                 'options' => ['placeholder'=>'เลือกหน่วยนับ']
                                             ])->label(false) ?>
                                         </div>
                                     </div>



                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ราคา <span class="required"></span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                               <?= $form->field($model, 'price')->textInput(['maxlength' => true,'class'=>'form-control','value'=>$model->price!=""?$model->price:0])->label(false) ?>
                                            </div>
                                          </div>


                                 </div>

                            </div>

                           <hr />
                            <p><h3>รูปภาพ</h3></p>
                      <div class="row">
                          <div class="col-lg-12">
                              <?php if(!$model->isNewRecord): ?>
                                  <div class="panel panel-body">  <div class="row">
                                          <?php foreach ($modelpic as $value):?>

                                              <div class="col-xs-6 col-md-3">
                                                  <a href="#" class="thumbnail">
                                                      <img src="../../backend/web/uploads/<?=$value->picture?>" alt="">
                                                  </a>
                                                  <div class="btn btn-default" data-var="<?=$value->id?>" onclick="removepic($(this));">ลบ</div>
                                              </div>

                                              <?php //echo Html::img("../../frontend/web/img/screenshots/".$value->filename,['width'=>'10%','class'=>'thumbnail']) ?>
                                          <?php endforeach;?></div>
                                  </div>
                              <?php endif;?>

                          </div>
                      </div>
                            <div class="row">
                                <div class="col-ltg-12">
                                    <?php

                                    echo FileInput::widget([
                                    'model' => $modelfile,
                                    'attribute' => 'file[]',
                                    'options' => ['multiple' => true],
                                        'pluginOptions' => [
                                                'allowUpload'=>false,
                                        ]
                                    ]);
                                    ?>
                                </div>
                            </div>


                      <hr />

                        <div class="col-md-8 col-md-offset-4">
                           <?= Html::submitButton(Yii::t('app', 'บันทึก'), ['class' => 'btn btn-success']) ?>
                           <?php if(!$model->isNewRecord):?>
                            <div class="btn btn-default"><a href="<?=Url::to(['product/view/','id'=>$model->id],true)?>">ดูรายละเอียด</a></div>
                          <?php endif;?>
                            <div class="btn btn-danger"><a style="color: #FFF" href="<?=Url::to(['product/index'],true)?>">ยกเลิก</a></div>
                        </div>
                  </div>
    </div>

    <?php ActiveForm::end(); ?>


        </div>
    </div>

</div>

<?php
$url_to_del_pic = Url::to(['product/deletepic'],true);
 $js =<<<JS
  $(function() {
    
  });
function addLine(e) {
   var tr = $(".table-list tbody tr:last");
        var clone = tr.clone();
        tr.closest("tr").find(".add-line").remove();
        clone.closest("tr").find(".vendor_code").val("");
        clone.closest("tr").find(".line-price").val("");
        tr.after(clone);
        linenum(); 
}
function removeline(e){
    var n = $(".table-list tbody tr").length;
   
   if(n==1){return false;}
    e.parent().parent().remove();
     var tr = $(".table-list tbody tr:last");
     var x = tr.closest("tr").find("td:eq(2)").val();

     tr.closest("tr").find("td:eq(3)").append('<i class="fa fa-plus-circle text-success add-line" style="cursor: pointer;vertical-align: middle;" onclick="addLine($(this));" ></i>');
}
function findItem(e) {
      currow = e.parent().parent().parent().parent().index();
     // alert(currow);
      $("#findModal").modal("show");
  }
  function getitem(e) {
    var prodcode = e.closest("tr").find("td:eq(0)").text();
    var prodname = e.closest("tr").find("td:eq(1)").text();
    var prodid = e.closest("tr").find(".recid").val();
    
    $(".table-list tbody tr").each(function() {
        //alert('niran');
        if($(this).index() == currow){
              $(this).closest('tr').find(".vendor_code").val(prodname.trim());
              $(this).closest('tr').find(".vendor_id").val(prodid);
              $(this).closest('tr').find('.line-price').focus().select();
        }
    });
    $("#findModal").modal("hide");
      
   }
    function linenum() {
    var nums = 0;
     $(".table-list tbody tr").each(function() {
         nums+=1;
      $(this).closest('tr').find('.line-no').text(nums);
        
    });
  }
  function removepic(e){
   // alert(e.attr("data-var"));return;
    if(confirm("ต้องการลบรูปภาพนี้ใช่หรือไม่")){
        $.ajax({
           'type':'post',
           'dataType':'html',
           'url':"$url_to_del_pic",
           'data': {'pic_id':e.attr("data-var")},
           'success': function(data) {
             location.reload();
           }
        });
    }
  }
JS;

 $this->registerJs($js,static::POS_END);

?>
