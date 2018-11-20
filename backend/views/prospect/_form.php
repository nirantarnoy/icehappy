<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prospect-form">
    <?php $form = ActiveForm::begin(); ?>
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
                for($i=0;$i<=count($list)-1;$i++):?>
                <?php $id+=1;?>
                <input type="checkbox" id="md_checkbox_<?=$id?>" class="filled-in chk-col-cyan" />
                <label for="md_checkbox_<?=$id?>"><?=$list[$i]['name']?></label>
                <?php endfor;?>

            </div>

          <div class="row">
              <div class="col-lg-3">
                  <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly']) ?>
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
                                       <tr>
                                           <td style="vertical-align: middle;">
                                               <input type="checkbox" id="item_checkbox_<?=$x?>" name="select_item[]" class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                               <label for="item_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                           </td>
                                           <td style="vertical-align: middle;">

                                           </td>
                                           <td style="vertical-align: middle;">
                                               <input type="number" name="item_qty[]" class="form-control line_qty" min="1" disabled>
                                           </td>
                                           <td style="vertical-align: middle;">
                                               กระสอบต่อวัน
                                           </td>
                                       </tr>
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
                                           <tr style="vertical-align: middle;">
                                               <td style="vertical-align: middle;">
                                                   <input type="checkbox" id="bucket_checkbox_<?=$x?>" class="filled-in chk-col-cyan" onchange="enableqty($(this));" />
                                                   <label for="bucket_checkbox_<?=$x?>"><?=$item[$x]['name']?></label>
                                               </td>
                                               <td style="vertical-align: middle;">

                                               </td>
                                               <td style="vertical-align: middle;">
                                                   <input type="number" name="item_bucket[]?>" class="form-control line_qty" min="1" disabled>
                                               </td>
                                               <td style="vertical-align: middle;">
                                                   <span>ใบ</span>
                                               </td>
                                           </tr>
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
                            <input type="file" id="input-file-max-fs" multiple class="dropify" data-max-file-size="2M" />
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
  $(function() {
    
  });
  function enableqty(e){
     
      if(e.prop("checked")){
          e.closest("tr").find(".line_qty").removeAttr('disabled');
      }else{
          e.closest("tr").find(".line_qty").prop('disabled','disabled');
      }
  }
   
JS;
$this->registerJs($js,static::POS_END);

?>
