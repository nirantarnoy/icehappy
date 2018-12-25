<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\Url;

use common\models\Province;
use common\models\Amphur;
use common\models\District;
/* @var $this yii\web\View */
/* @var $model backend\models\Custumer */
/* @var $form yii\widgets\ActiveForm */
$custgroup = \backend\models\Custumergroup::find()->all();
$zone = \backend\models\Salezone::find()->all();

$add_prov = $model_address_plant?$model_address_plant->province_id:0;

$prov = Province::find()->all();
$amp = Amphur::find()->where(['PROVINCE_ID'=>$add_prov])->all();
$dist = District::find()->where(['AMPHUR_ID'=> -1])->all();

$l = 1;
$old_item = '';
$m = 1;
$old_bucket = '';
$old_seeme = [];
if(count($item_select)>0){
    foreach ($item_select as $value){
        if($l < count($item_select)){
            $old_item .=$value->itemid.',';
        }else if($l == count($item_select)){
            $old_item .=$value->itemid;
        }
        $l+=1;
    }
}
if(count($bucket)>0) {
    foreach ($bucket as $value) {
        if ($m < count($bucket)) {
            $old_bucket .= $value->itemid . ',';
        } else if ($m == count($bucket)) {
            $old_bucket .= $value->itemid;
        }
        $m += 1;
    }
}
$url_to_findcity = Url::to(['plant/showcity'],true);
$url_to_finddistrict = Url::to(['plant/showdistrict'],true);
$url_to_findzipcode = Url::to(['plant/showzipcode'],true);
$js=<<<JS

   $(function(){
      
   });

  function findCity(e){
        $.post("$url_to_findcity" +"&id="+e.val(),function(data){
             $("select#city").html(data);
             $("select#city").prop("disabled","");

        });
                                          
  }
  function findDistrict(e){
        $.post("$url_to_finddistrict"+"&id="+e.val(),function(data){
             $("select#district").html(data);
             $("select#district").prop("disabled","");
        });
        $.post("$url_to_findzipcode"+"&id="+e.val(),function(data){
            $("#zipcode").val(data);
        });
                                          
  }
  
JS;
$this->registerJs($js,static::POS_END);

?>

<div class="custumer-form">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left','enctype'=>'multipart/form-data']]); ?>

            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true,'data-validation-required-message'=>'กรุณาป้อนข้อมูลรหัสลูกค้า']) ?>
                </div>
                <div class="col-lg-3">
                    <label for="">คำนำหน้า</label>
                    <select name="prefix" class="form-control" id="">
                        <?php
                        $list = \backend\helpers\Prefixname::asArrayObject();
                        for($i=0;$i<=count($list)-1;$i++):
                            ?>
                            <option value="<?=$list[$i]['id']?>"><?=$list[$i]['name']?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'card_id')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <label>กลุ่มลูกค้า</label>
                    <select name="customer_group" class="form-control" id="">

                        <?php foreach ($custgroup as $value):?>
                            <?php
                            $select = '';
                            if($model->customer_group_id == $value->id){$select = "selected";}
                            ?>
                            <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <label>เขต/เส้นทาง</label>
                    <select name="zone_id" class="form-control" id="">

                        <?php foreach ($zone as $value):?>
                            <?php
                            $select = '';
                            if($model->zone_id == $value->id){$select = "selected";}
                            ?>
                            <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">

                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-3">
                    <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label('สถานะ') ?>

                </div>
            </div>
            <hr />
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"><?=Yii::t('app','ที่อยู่')?>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <textarea name="address" id="address" class="form-control" cols="30" rows="3">
                                <?php echo $model_address_plant?trim($model_address_plant->address):'';?>
                            </textarea>
                            <?php //echo $form->field($model_address_plant?$model_address_plant:$model_address, 'address')->textarea(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="first-name"><?=Yii::t('app','ถนน')?>
                        </label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="text" class="form-control" name="street" value="<?=$model_address_plant?$model_address_plant->street:''?>">
                            <?php //echo $form->field($model_address_plant?$model_address_plant:$model_address, 'street')->textInput(['maxlength' => true,'class'=>'form-control'])->label(false) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-lg-12" for="first-name"><?=Yii::t('app','ตำบล')?>
                        </label>
                        <div class="col-lg-12">
                            <?php
                               $disabled = '';
                               if($model->isNewRecord){
                                  $disabled = 'disabled';
                               }
                            ?>
                            <select name="select_district" class="form-control" id="district" <?=$disabled?>>
                                <?php if($model->isNewRecord):?>
                                    <option value=""></option>
                                <?php else:?>
                                    <?php foreach ($dist as $value):?>
                                        <?php
                                        $select = '';
                                        $dis_id = $model_address_plant?$model_address_plant->district_id:0;
                                        if($value->DISTRICT_ID ==  $dis_id){$select = 'selected';}
                                        ?>
                                        <option value="<?=$value->DISTRICT_ID?>" <?=$select;?>><?=$value->DISTRICT_NAME?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-lg-12" for="first-name"><?=Yii::t('app','อำเภอ')?>
                        </label>
                        <div class="col-lg-12">
                            <?php
                            $disabled = '';
                            if($model->isNewRecord){
                                $disabled = 'disabled';
                            }
                            ?>
                            <select name="select_city" onchange="findDistrict($(this))" class="form-control" id="city" <?=$disabled?>>
                                <?php if($model->isNewRecord):?>
                                    <option value=""></option>
                                <?php else:?>
                                    <?php foreach ($amp as $value):?>
                                        <?php
                                        $select = '';
                                        $city_id = $model_address_plant?$model_address_plant->city_id:0;
                                        if($value->AMPHUR_ID ==  $city_id){$select = 'selected';}
                                        ?>
                                        <option value="<?=$value->AMPHUR_ID?>" <?=$select?>><?=$value->AMPHUR_NAME?></option>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-lg-12" for="first-name"><?=Yii::t('app','จังหวัด')?>
                        </label>
                        <div class="col-lg-12">
                            <select name="select_province" onchange="findCity($(this))" class="form-control" id="">
                                <?php foreach ($prov as $value):?>
                                    <?php
                                    $select = '';
                                    $prov_id = $model_address_plant?$model_address_plant->province_id:0;
                                    if($value->PROVINCE_ID ==  $prov_id){$select = 'selected';}
                                    ?>
                                    <option value="<?=$value->PROVINCE_ID?>" <?=$select?>><?=$value->PROVINCE_NAME?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group" style="margin-top: -10px">
                        <label class="control-label col-lg-12" for="first-name"><?=Yii::t('app','รหัสไปรษณีย์')?>
                        </label>
                        <div class="col-lg-12">
                            <?php if($model_address_plant):?>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="<?=$model_address_plant->zipcode?>" readonly>
                                <?php //echo $form->field($model_address_plant, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','readonly'=>'readonly'])->label(false) ?>
                            <?php else:?>
                                <input type="text" name="zipcode" class="form-control" id="zipcode" value="" readonly>
                                <?php //echo $form->field($model_address, 'zipcode')->textInput(['class'=>'form-control','id'=>'zipcode','readonly'=>'readonly'])->label(false) ?>
                            <?php endif;?>

                        </div>
                    </div>
                </div>
            </div>
            <?php if(!$model->isNewRecord):?>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            ราคาสินค้า
                            <div class="card-actions">
                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                            </div>
                        </div>
                        <div class="card-body collapse show">
                            <table>
                                <thead>
                                <tr>
                                    <th>รายการ</th>
                                    <th style="width: 30%">จำนวน</th>
                                    <th style="width: 30%">ราคา</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $item = \backend\helpers\item::asArrayObject();
                                for($x=0;$x<=count($item)-1;$x++):
                                    ?>
                                    <?php if($model->isNewRecord):?>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <input type="hidden" name="select_item[]" class="select_item" value="">
                                            <!--                                               <input type="hidden" name="select_item_qty" class="select_item_qty" value="">-->
                                            <input type="checkbox" value="<?=$item[$x]['id']?>" id="item_checkbox_<?=$x?>" name="" class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                            <label for="item_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                        </td>
                                        <td style="vertical-align: middle;">
                                            <input type="number" name="item_qty[]" class="form-control line_qty" min="1" value="" disabled >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control line_price" name="item_price[]" value="" disabled>
                                        </td>
                                    </tr>
                                <?php else:?>
                                    <?php
                                    $checked = '';
                                    $disabled = 'disabled';
                                    $checked_qty = '';
                                    $checked_price= '';
                                    $old_select = '';
                                    $checked_item = '';
                                    $l = 0;
                                    foreach ($item_select as $value){

                                        if($value->itemid == $item[$x]['id']){
                                            $checked = 'checked';
                                            $checked_qty = $value->qty;
                                            $checked_price = $value->line_price;
                                            $disabled = '';

                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td style="vertical-align: middle;">
                                            <input type="hidden" name="select_item" class="select_item" value="">
                                            <input type="checkbox" value="<?=$item[$x]['id']?>" name="item_check" id="item_checkbox_<?=$x?>" name="" <?=$checked?> class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                            <label for="item_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                        </td>

                                        <td style="vertical-align: middle;">
                                            <input type="number" name="item_qty[]" class="form-control line_qty" min="1" value="<?=$checked_qty?>" <?=$disabled?> >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control line_price" name="item_price[]" value="<?=$checked_price?>" <?=$disabled?>>
                                        </td>
                                    </tr>
                                <?php endif;?>
                                <?php endfor;?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
<!--                <div class="col-lg-6">-->
<!--                    <div class="card">-->
<!--                        <div class="card-header">-->
<!--                            ราคาเช่าถัง-->
<!--                            <div class="card-actions">-->
<!--                                <a class="" data-action="collapse"><i class="ti-minus"></i></a>-->
<!--                                <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>-->
<!--                                <a class="btn-close" data-action="close"><i class="ti-close"></i></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                        <div class="card-body collapse show">-->
<!--                            <table class="table table-striped">-->
<!--                                <thead>-->
<!--                                <tr>-->
<!--                                    <th>#</th>-->
<!--                                    <th>สินค้า</th>-->
<!--                                    <th>ราคา</th>-->
<!--                                </tr>-->
<!--                                </thead>-->
<!---->
<!---->
<!--                            </table>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->

            </div>
            <?php endif;?>
            <?php if($model->isNewRecord):?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h4 class="card-title">สนใจน้ำแข็ง</h4>
                                            <table>
                                                <?php
                                                $item = \backend\helpers\item::asArrayObject();
                                                for($x=0;$x<=count($item)-1;$x++):
                                                    ?>
                                                    <?php if($model->isNewRecord):?>
                                                    <tr>
                                                        <td style="vertical-align: middle;">
                                                            <input type="hidden" name="select_item" class="select_item" value="">
                                                            <!--                                               <input type="hidden" name="select_item_qty" class="select_item_qty" value="">-->
                                                            <input type="checkbox" value="<?=$item[$x]['id']?>" id="item_checkbox_<?=$x?>" name="" class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                                            <label for="item_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                                        </td>
                                                        <td style="vertical-align: middle;">

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input type="number" name="item_qty[]" class="form-control line_qty" min="1" value="" disabled >
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            กระสอบต่อวัน
                                                        </td>
                                                    </tr>
                                                <?php else:?>
                                                    <?php
                                                    $checked = '';
                                                    $disabled = 'disabled';
                                                    $checked_qty = '';
                                                    $old_select = '';
                                                    $checked_item = '';
                                                    $l = 0;
                                                    foreach ($item_select as $value){

                                                        if($value->itemid == $item[$x]['id']){
                                                            $checked = 'checked';
                                                            $checked_qty = $value->qty;
                                                            $disabled = '';

                                                        }
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td style="vertical-align: middle;">
                                                            <input type="hidden" name="select_item" class="select_item" value="">
                                                            <input type="checkbox" value="<?=$item[$x]['id']?>" id="item_checkbox_<?=$x?>" name="" <?=$checked?> class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                                            <label for="item_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                                        </td>
                                                        <td style="vertical-align: middle;">

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input type="number" name="item_qty[]" class="form-control line_qty" min="1" value="<?=$checked_qty?>" <?=$disabled?> >
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            กระสอบต่อวัน
                                                        </td>
                                                    </tr>
                                                <?php endif;?>
                                                <?php endfor;?>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="card-title">ถังน้ำแข็ง</h4>
                                            <table>
                                                <?php
                                                $item = \backend\helpers\Bucket::asArrayObject();
                                                for($x=0;$x<=count($item)-1;$x++):
                                                    ?>
                                                    <?php if($model->isNewRecord):?>
                                                    <tr style="vertical-align: middle;">
                                                        <td style="vertical-align: middle;">
                                                            <input type="hidden" name="select_bucket" class="select_bucket" value="">
                                                            <input type="checkbox" value="<?=$item[$x]['id']?>"  id="bucket_checkbox_<?=$x?>" class="filled-in chk-col-cyan" onchange="enableqty2($(this));" />
                                                            <label for="bucket_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                                        </td>
                                                        <td style="vertical-align: middle;">

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input type="number" name="bucket_qty[]" class="form-control line_qty" min="1" disabled>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <span>ใบ</span>
                                                        </td>
                                                    </tr>
                                                <?php else:?>
                                                    <?php
                                                    $checked = '';
                                                    $disabled = 'disabled';
                                                    $checked_qty = '';
                                                    $old_select = '';
                                                    $checked_item = '';
                                                    $l = 0;
                                                    foreach ($bucket as $value){
                                                        if($value->itemid == $item[$x]['id']){
                                                            $checked = 'checked';
                                                            $checked_qty = $value->qty;
                                                            $disabled = '';

                                                        }
                                                    }
                                                    ?>
                                                    <tr style="vertical-align: middle;">
                                                        <td style="vertical-align: middle;">
                                                            <input type="hidden" name="select_bucket" class="select_bucket" value="">
                                                            <input type="checkbox" value="<?=$item[$x]['id']?>" id="bucket_checkbox_<?=$x?>" class="filled-in chk-col-cyan" <?=$checked?> onchange="enableqty2($(this));" />
                                                            <label for="bucket_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                                        </td>
                                                        <td style="vertical-align: middle;">

                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <input type="number" name="bucket_qty[]" class="form-control line_qty" min="1" value="<?=$checked_qty?>" <?=$disabled?>>
                                                        </td>
                                                        <td style="vertical-align: middle;">
                                                            <span>ใบ</span>
                                                        </td>
                                                    </tr>
                                                <?php endif;?>
                                                <?php endfor;?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">อัพโหลดรูปภาพ</h4>
                            <label for="input-file-max-fs">You can add a max file size</label>
                            <input type="file" name="imagefile[]" id="input-file-max-fs" multiple class="dropify" data-max-file-size="2M" />

                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <?php if(!$model->isNewRecord): ?>
                        <div class="row">
                            <?php foreach ($modelfile as $value):?>

                                <div class="col-xs-6 col-md-3">
                                    <div class="card">
                                        <img class="card-img-top img-responsive" src="../../backend/web/uploads/images/<?=$value->name?>" alt="Card image cap">
                                        <div class="card-body">
                                            <a href="#" onclick="removepic($(this));" class="btn btn-danger">Delete</a>
                                        </div>
                                    </div>
                                </div>

                                <?php //echo Html::img("../../frontend/web/img/screenshots/".$value->filename,['width'=>'10%','class'=>'thumbnail']) ?>
                            <?php endforeach;?>
                        </div>

                    <?php endif;?>
                </div>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
<?php
$url_to_del_pic = Url::to(['customer/deletepic'],true);
$js =<<<JS

 var item_list = [];
 var bucket_list = [];

  $(function() {
      $(".select_item").val('$old_item');
       $(".select_bucket").val('$old_bucket');
       item_list = [$(".select_item").val()];
       bucket_list = [$(".select_bucket").val()];
  });
  ! function(window, document, $) {
        "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green"
        }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
    }(window, document, jQuery);
  function removepic(e){
   // alert(e.attr("data-var"));return;
  // alert('$url_to_del_pic');
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
  function enableqty(e){
      if(e.prop("checked")){
          e.closest("tr").find(".line_qty").removeAttr('disabled');
          e.closest("tr").find(".line_qty").val(1);
          
          e.closest("tr").find(".line_price").removeAttr('disabled');
          e.closest("tr").find(".line_price").val(1);
          
          item_list.push(e.val());
      }else{
          e.closest("tr").find(".line_qty").prop('disabled','disabled').val('');
          e.closest("tr").find(".line_price").prop('disabled','disabled').val('');
          item_list.splice(item_list.indexOf(e.val() ), 1);
          
      }
      //alert(item_list);
     $(".select_item").val(item_list);

  }
  function enableqty2(e){
      if(e.prop("checked")){
          e.closest("tr").find(".line_qty").removeAttr('disabled');
          e.closest("tr").find(".line_qty").val(1);
          bucket_list.push(e.val());
      }else{
          e.closest("tr").find(".line_qty").prop('disabled','disabled').val('');
          bucket_list.splice(bucket_list.indexOf(e.val() ), 1);
          
      }
      //alert(item_list);
   
     $(".select_bucket").val(bucket_list);
  }
JS;

$this->registerJs($js,static::POS_END);

?>
