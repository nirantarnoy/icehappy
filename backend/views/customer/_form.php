<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model backend\models\Custumer */
/* @var $form yii\widgets\ActiveForm */
$custgroup = \backend\models\Custumergroup::find()->all();
$zone = \backend\models\Salezone::find()->all();

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


?>

<div class="custumer-form">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(['options'=>['class'=>'form-horizontal form-label-left','enctype'=>'multipart/form-data']]); ?>
            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'card_id')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'customer_type_id')->textInput() ?>


                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'status')->textInput() ?>

                    <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label('สถานะ') ?>

                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
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
                    <br><br>
                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
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
            </div>
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


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">อัพโหลดรูปภาพ</h4>
                            <label for="input-file-max-fs">You can add a max file size</label>
                            <input type="file" id="input-file-max-fs" multiple class="dropify" data-max-file-size="2M" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <?php if(!$model->isNewRecord): ?>
                    <div class="card-group">
                                <?php foreach ($modelpic as $value):?>

                                    <div class="card">
                                        <img class="card-img-top img-responsive" style="width: 20%" src="../../backend/web/uploads/images/<?=$value->name?>" alt="Card image cap">
                                        <div class="card-body">
                                            <a href="javascript:void(0)" class="btn btn-danger" data-var="<?=$value->id?>" onclick="removepic($(this));">ลบ</a>
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
  $(function() {
      $(".select_item").val('$old_item');
  });
  function removepic(e){
   // alert(e.attr("data-var"));return;
   alert('$url_to_del_pic');
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
JS;

$this->registerJs($js,static::POS_END);

?>
