<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */
/* @var $form yii\widgets\ActiveForm */


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
if(count($seeme)>0){
    foreach ($seeme as $value){
        array_push($old_seeme,$value->itemid);
    }
}

//print_r($old_seeme);

?>


<div class="prospect-form">
    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>
    <div class="card">
        <div class="card-body">


            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?php //echo $form->field($model, 'delivery_type')->textInput(['maxlength' => true]) ?>
                    <label for="">ประเภทจัดส่ง</label>
                    <select name="delivery_type" class="form-control" id="">
                        <?php
                             $list = \backend\helpers\DeliveryType::asArrayObject();
                             for($i=0;$i<=count($list)-1;$i++):
                           ?>
                                 <option value="<?=$list[$i]['id']?>"><?=$list[$i]['name']?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'delivery_place')->textarea(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6"></div>
            </div>




            <h4 class="card-title m-t-40">รู้จักเราจาก</h4>
            <div class="demo-checkbox">
                <?php //echo $form->field($model, 'seeme[]')->checkboxList(['niran','tarlek'],['class'=>'filled-in chk-col-pink','checked'=>'checked']) ?>
<!--                <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-red" checked />-->
                <?php
                $list = \backend\helpers\SeeType::asArrayObject();
                $id = 0;
                $seeme_checked = '';
                for($i=0;$i<=count($list)-1;$i++):?>
                <?php $id+=1;?>
                    <?php if($model->isNewRecord):?>
                        <input type="checkbox" name="seeme[]" value="<?=$list[$i]['id']?>" id="seeme_checkbox_<?=$id?>" class="filled-in chk-col-cyan" />
                        <label for="seeme_checkbox_<?=$id?>"><?=$list[$i]['name']?></label>
                    <?php else:?>

                        <?php
                           if(in_array($list[$i]['id'],$old_seeme)){
                               $seeme_checked = 'checked';
                           }else{
                               $seeme_checked = '';
                           }
                        ?>

                        <input type="checkbox" name="seeme[]" value="<?=$list[$i]['id']?>" id="seeme_checkbox_<?=$id?>" <?=$seeme_checked?> class="filled-in chk-col-cyan" />
                        <label for="seeme_checkbox_<?=$id?>"><?=$list[$i]['name']?></label>
                    <?php endif;?>
                <?php endfor;?>

            </div>

          <div class="row">
              <div class="col-lg-3">
                  <label for="">สถานะ</label>
                  <?php if($model->isNewRecord):?>
                        <input type="text" class="form-control" value="<?=\backend\helpers\ProspectStatus::getTypeById(1)?>" disabled>
                  <?php else:?>
                        <input type="text" class="form-control" value="<?=\backend\helpers\ProspectStatus::getTypeById($model->status)?>" disabled>
                  <?php endif;?>
                  <?= $form->field($model, 'status')->hiddenInput(['readonly'=>'readonly'])->label(false) ?>
              </div>
          </div>




    <div class="form-group">
        <?= Html::submitButton('บันทึก', ['class' => 'btn btn-success']) ?>
        <div class="btn btn-primary">อนุมัติลูกค้า</div>
    </div>


        </div>
    </div>
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
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">อัพโหลดรูปภาพ</h4>
                            <label for="input-file-max-fs">You can add a max file size</label>
                            <input type="file" name="imagefile[]" id="input-file-max-fs" multiple class="dropify" data-max-file-size="2M" />
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php if(count($modelfile)>0): ?>
                                        <?php $list = [];?>
                                        <?php foreach ($modelfile as $value):?>
                                            <?php array_push($list,
                                                [
                                                    'url' => '../web/uploads/images/'.$value->name,
                                                    'src' => '../web/uploads/thumbnail/'.$value->name,
                                                    'options' =>[
                                                        'title' => 'ทดสอบรูปภาพ',
                                                        'style' => ['width'=>20]
                                                    ],
                                                    'template'=>""
                                                ]
                                            );?>
                                        <?php endforeach;?>

                                    <?php endif;?>
                                    <?php $items = [
                                        [
                                            'url' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_b.jpg',
                                            'src' => 'http://farm8.static.flickr.com/7429/9478294690_51ae7eb6c9_s.jpg',
                                            'options' => array('title' => 'Camposanto monumentale (inside)')
                                        ],
                                        [
                                            'url' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_b.jpg',
                                            'src' => 'http://farm4.static.flickr.com/3825/9476606873_42ed88704d_s.jpg',
                                            'options' => array('title' => 'Sail us to the Moon')
                                        ],
                                        [
                                            'url' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_b.jpg',
                                            'src' => 'http://farm4.static.flickr.com/3749/9480072539_e3a1d70d39_s.jpg',
                                            'options' => array('title' => 'Sail us to the Moon')
                                        ],

                                    ];?>
                                    <?= dosamigos\gallery\Gallery::widget(['items' => $list]);?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$js=<<<JS
  var item_list = [];
  var bucket_list = [];
  var item_list_qty = [];
  $(function() {
    $(".select_item").val('$old_item');
    $(".select_bucket").val('$old_bucket');
    item_list = [$(".select_item").val()];
    bucket_list = [$(".select_bucket").val()];
    //alert($old_bucket);
  });
  function enableqty(e){
      if(e.prop("checked")){
          e.closest("tr").find(".line_qty").removeAttr('disabled');
          e.closest("tr").find(".line_qty").val(1);
          
          item_list.push(e.val());
      }else{
          e.closest("tr").find(".line_qty").prop('disabled','disabled').val('');
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
