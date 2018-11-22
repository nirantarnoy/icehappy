<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Sale */
/* @var $form yii\widgets\ActiveForm */

$cust = \backend\models\Custumer::find()->all();
?>

<div class="sale-form">
    <div class="card">
        <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-lg-4">
                        <?= $form->field($model, 'sale_no')->textInput(['maxlength' => true,'readonly'=>'readonly']) ?>
                    </div>
                    <div class="col-lg-4">
                        <?php //echo $form->field($model, 'trans_date')->textInput() ?>

                        <div class="form-group">
                            <label for="">Sale Date</label>
                                 <?php $dateval = "".$model->isNewRecord?date('Y-m-d')."":"".date('Y-m-d',$model->trans_date)."";?>

                                <input class="form-control" name="trans_date" type="date" value=<?=$dateval?> id="example-date-input">

                        </div>

                    </div>
                    <div class="col-lg-4">
                        <?php //echo $form->field($model, 'customer_id')->textInput() ?>
                        <label for="">Customer</label>
                        <select name="customer_id" class="form-control" id="">

                            <?php foreach ($cust as $value):?>
                                <?php
                                $select = '';
                                if($model->customer_id == $value->id){$select = "selected";}
                                ?>
                                <option value="<?=$value->id?>" <?=$select?>><?=$value->code." ".$value->first_name?></option>
                            <?php endforeach;?>

                        </select>
                    </div>
                </div>
            <div class="row">
                <div class="col-lg-4">
                    <?php //echo $form->field($model, 'payment_type_id')->textInput() ?>
                    <label for="">Payment Method</label>
                    <select name="customer_id" class="form-control" id="">
                        <?php
                           $list = \backend\helpers\PaymentType::asArrayObject();
                           ?>
                        <?php for($i=0;$i<=count($list)-1;$i++):?>
                            <?php
                            $select = '';
                            if($model->payment_type_id == $list[$i]['id']){$select = "selected";}
                            ?>
                            <option value="<?=$list[$i]['id']?>" <?=$select?>><?=$list[$i]['name']?></option>
                        <?php endfor;?>

                    </select>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'sale_total')->textInput(['readonly'=>'readonly']) ?>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly']) ?>
                </div>

            </div>


                <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                </div>

            <hr>
            <table class="table table-item">
                <thead>
                <tr style="background-color: #00b488;color: #FFF">
                    <th>#</th>
                    <th>รหัส</th>
                    <th>ชื่อ</th>
                    <th style="text-align: right">จำนวน</th>
                    <th style="text-align: right">ราคา</th>
                    <th style="text-align: right">รวม</th>
                    <th style="text-align: center">-</th>
                </tr>
                </thead>
                <tbody>
                <?php if($model->isNewRecord):?>
                    <tr>
                        <td style="width: 5%;padding-top: 15px;" class="line-no"></td>
                        <td style="width: 30%">
                            <div class="input-group">
                                <input type="text" class="form-control product_code" placeholder="รหัสสินค้า" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1" onclick="findItem($(this));"><i class="fa fa-search"></i></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <input type="text" readonly name="product_name[]" class="form-control product-name" value="">
                        </td>
                        <td>
                            <input style="border: none;padding: 5px 5px 5px 5px;width: 100%;background:transparent;text-align: right" type="text" name="line_qty[]" class="form-control line-qty" value="0" onchange="linecal($(this));">
                        </td>
                        <td>
                            <input style="border: none;padding: 5px 5px 5px 5px;width: 100%;background:transparent;text-align: right" type="text" name="line_price[]" class="form-control line-price" value="0" onchange="linecal($(this));">
                            <input style="border: none;padding: 5px 5px 5px 5px;width: 100%;background:transparent;text-align: right" type="hidden" name="line_stock_price[]" class="form-control line-stock-price" value="0">
                        </td>
                        <td>
                            <input style="border: none;padding: 5px 5px 5px 5px;width: 100%;background:transparent;text-align: right" name="line_total[]" readonly type="text" class="form-control line-total" value="0">
                        </td>
                        <td>
                            <i class="fa fa-minus-circle text-danger remove-line" style="cursor: pointer;vertical-align: middle;" onclick="removeline($(this));"></i>
                        </td>

                    </tr>
                <?php else:?>
                    <?php foreach ($modelline as $value):?>
                        <tr>
                            <td style="width: 5%;padding-top: 15px;" class="line-no"></td>
                            <td style="width: 30%">
                                <div class="input-group">
                                    <input type="text" onchange="productChange($(this))" name="product_code[]" class="form-control product_code" placeholder="ค้นหารหัส..." value="<?=\backend\models\Product::findProductCode($value->product_id)?>">
                                    <input type="hidden" class="product_id" name="product_id[]" value="<?=$value->product_id?>">
                                    <span class="input-group-btn">
                                    <div class="btn btn-default btn-search-item"  onclick="findItem($(this));"><i class="fa fa-search-plus"></i></div>
                                </span>
                                </div>
                            </td>
                            <td>

                                <input type="text" readonly name="product_name[]" class="form-control product-name" value="<?=\backend\models\Product::findName($value->product_id)?>">
                            </td>
                            <td>
                                <input style="text-align: right" type="text" name="line_qty[]" class="form-control line-qty" value="<?=$value->qty?>" onchange="linecal($(this));">
                            </td>
                            <td>
                                <input style="text-align: right" type="text" name="line_price[]" class="form-control line-price" value="<?=$value->price?>" onchange="linecal($(this));">
                                <input style="border: none;padding: 5px 5px 5px 5px;width: 100%;background:transparent;text-align: right" type="text" name="line_stock_price[]" class="form-control line-stock-price" value="<?=$value->stock_price_id?>">
                            </td>
                            <td>
                                <input style="text-align: right;" name="line_total[]" readonly type="text" class="form-control line-total" value="<?=$value->line_total?>">
                            </td>
                            <td>
                                <i class="fa fa-minus-circle text-danger remove-line" style="cursor: pointer;vertical-align: middle;" onclick="removeline($(this));"></i>
                            </td>

                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7">
                        <?php if($model->status <=1):?>
                            <div class="btn btn-default btn-add-line"><i class="fa fa-plus-circle"></i> เพิ่มรายการ </div>
                        <?php endif;?>
                    </td>
                </tr>
                </tfoot>
            </table>

                <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
<div id="findModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">ค้นหารหัสสินค้า</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="text" placeholder="ใส่คำค้นแล้วกด Enter" class="form-control itemsearch" name="itemsearch" >
                <br><br>
                <table class="table table-striped table-bordered table-hover table-list">
                    <thead>
                    <tr style="background-color: #2aabd2;color: #FFF;">
                        <th>รหัส</th>
                        <th>ชื่อ</th>
                    </tr>
                    </thead>
                    <tbody>
                       <?php if(count($modelproduct)>0):?>
                       <?php foreach ($modelproduct as $value):?>
                           <tr>
                               <td><?=$value->product_code;?></td>
                               <td><?=$value->name;?></td>
                           </tr>
                       <?php endforeach;?>
                       <?php endif;?>
                    </tbody>
                </table>
                <div class="modal-error" style="display: none;">
                    <i class="fa fa-exclamation-triangle text-danger"> ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง</i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect btn-ok" data-dismiss="modal">ตกลง</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<?php
$url_to_find = Url::to(['sale/finditem'],true);
$url_to_find_full = Url::to(['sale/finditemfull'],true);
$url_to_find_all = Url::to(['sale/finditemall'],true);
$url_to_loan = Url::to(['sale/loan'],true);
$url_to_findmaxprice = Url::to(['sale/findmaxprice'],true);
$url_to_find_loan = Url::to(['sale/findloan'],true);
$js=<<<JS
  $(function() {
      var currow = -1;
      linenum();
    $(".btn-add-line").click(function() {
        alert();
       var tr = $(".table-item tbody tr:first");
       if(tr.closest("tr").find(".product_code").val()== "")return;
       var clone = tr.clone();
       clone.closest("tr").find(".product_code").val("");
       clone.closest("tr").find(".product-name").val("");
       clone.closest("tr").find(".line-qty").val("0");
       clone.closest("tr").find(".line-price").val("0");
       clone.closest("tr").find(".line-total").val("0");
       tr.after(clone);
       linenum();
    });
    $(".btn-ok").click(function() {
       $(".table-list tbody tr").each(function() {
           var id = $(this).find(".recid").val();
           //alert(id);
       })
    })
    $(".itemsearch").change(function(){
        if($(this).val()!=''){
            $.ajax({
              'type':'post',
              'dataType': 'json',
              'url': "$url_to_find",
              'data': {'txt': $(this).val()},
              'success': function(data) {
                // alert(data);return;
                 if(data.length == 0){
                      $(".table-list").hide();
                     $(".modal-error").show();
                 }else{
                     $(".modal-error").hide();
                     $(".table-list").show();
                     var html = "";
                     for(var i =0;i<=data.length -1;i++){
                         html +="<tr ondblclick='getitem($(this));'><td>"+data[i]['product_code']+"</td><td>"+data[i]['name']+"<input type='hidden' class='recid' value='"+data[i]['id']+"'/></td></tr>"
                     }
                     $(".table-list tbody").html(html);
                     
                 }
              }
            });
        }
    });
     $(".btn-cal").click(function() {
      calall();
      //$("#loanModal").modal("show").find(".total_pop").text(parseFloat($(".total").val()).toFixed(0));
      //$("#loanModal").find(".total-amount").val($(".total").val());
      
      var saleid = "$model->id";
      
      $.ajax({
              'type':'post',
              'dataType': 'json',
              'url': "$url_to_find_loan",
              'async': false,
              'data': {'saleid': saleid},
              'success': function(data) {
                 //alert(data['sale_id']);return;
                  $("#loanModal").modal("show").find(".total_pop").text(parseFloat($(".total").val()).toFixed(0));
                  $("#loanModal").find(".total-amount").val($(".total").val());
                  $("#loanModal").find(".all_period").val(data['period']);
                  $("#loanModal").find(".per_fee").val(data['loan_percent']);
                  $("#loanModal").find(".per_qty").val(data['payment_per']);
                  $("#loanModal").find(".pay_day").val(data['pay_ever_day']);
                  $("#loanModal").find(".fee_rate").val(data['fee_rate']);
           
              }
            });
      
      
      
    });
     
     $(".btn-three,.btn-six,.btn-nine,.btn-twel").click(function() {
        var n = $(this).attr("data-var");
        var total = $(".total-amount").val();
        $(".all-period").val(n);
        $(".per_qty").val((total / n));
     });
     
     $(".per_fee").change(function() {
        var period = $(".all-period").val();
        var total = $(".total-amount").val();
        var per = $(this).val();
        
        var normal = (total / period);
        var all_interest = (total * per) / 100;
        var per_interest = (all_interest / period);
        var grand_total = normal + per_interest;
        $(".per_qty").val(grand_total);
        
     });
     
     $(".btn-loan-ok").click(function(){
        var saleid = "$model->id";
        var allperiod = $(".all_period").val();
        var loanper = $(".per_fee").val();
        var perqty = $(".per_qty").val();
        var payday = $(".pay_day").val();
        var feerate = $(".fee_rate").val();
        var sdate = $("#s_date").val();
        var ndate = $("#n_date").val();
        
      //  alert(ndate);return;
        
        $.ajax({
              'type':'post',
              'dataType': 'html',
              'url': "$url_to_loan",
              'data': {'saleid': saleid,'allperiod': allperiod,'loanper': loanper,'perqty': perqty,'payday': payday,'feerate':feerate,'sdate': sdate,'ndate': ndate},
              'success': function(data) {
                // alert(data);return;
                
              }
            });
     });
     
  });
  function findItem(e) {
      //alert();
      currow = e.parent().parent().parent().parent().index();
     // alert(currow);
      $("#findModal").modal("show");
      producAll();
  }
  function removeline(e) {
    if(confirm("ต้องการลบรายการนี้ใช่หรือ")){
      
        e.parent().parent().remove();
    }
  }
  function getitem(e) {
    var prodcode = e.closest("tr").find("td:eq(0)").text();
    var prodname = e.closest("tr").find("td:eq(1)").text();
    var prodid = e.closest("tr").find(".recid").val();
    $(".table-item tbody tr").each(function() {
       // alert(prodcode);
        if($(this).index() == currow){
              var maxprice = 0;
              var stock_price_id = 0;
              $.ajax({
                  'type':'post',
                  'dataType': 'json',
                  'url': "$url_to_findmaxprice",
                  'async': false,
                  'data': {'prodid': prodid},
                  'success': function(data) {
                    maxprice = data[0]['price'];
                    stock_price_id = data[0]['stock_price_id'];
                    
                  }
              });
            
              $(this).closest('tr').find(".product_code").val(prodcode);
              $(this).closest('tr').find(".product_id").val(prodid);
              $(this).closest('tr').find(".product-name").val(prodname);
              $(this).closest('tr').find('.line-qty').focus().select();
              $(this).closest('tr').find('.line-price').val(maxprice);
              $(this).closest('tr').find('.line-stock-price').val(stock_price_id);
              
        }
    });
    $("#findModal").modal("hide");
    
   
  }
  function linecal(e) {
    var qty = e.closest("tr").find(".line-qty").val();
    var price = e.closest("tr").find(".line-price").val();
    e.closest("tr").find(".line-total").val(parseFloat(qty)*parseFloat(price));
    calall();
  }
  function calall(){
      var total_all = 0;
      $(".table-item tbody tr").each(function() {
         total_all = total_all + parseFloat($(this).closest("tr").find(".line-total").val());
      });
      $(".total").val(total_all);
  }
  function linenum() {
      var nums = 0;
     $(".table-item tbody tr").each(function() {
         nums+=1;
      $(this).closest('tr').find('.line-no').text(nums);
        
    });
  }
  function productChange(e){
      if(e.val()!=''){
            $.ajax({
              'type':'post',
              'dataType': 'json',
              'url': "$url_to_find_full",
              'async': false,
              'data': {'txt': e.val()},
              'success': function(data) {
                 e.closest("tr").find(".product_id").val(data[0]['product_id']);
                 e.closest("tr").find(".product-name").val(data[0]['name']);
                 e.closest("tr").find(".line-price").val(data[0]['maxprice']);
                 e.closest("tr").find(".line-qty").focus().select();
              }
            });
        }
  }
  function producAll(){
      
              $.ajax({
              'type':'post',
              'dataType': 'json',
              'url': "$url_to_find_all",
              'data': {'txt':  '*'},
              'success': function(data) {
                // alert(data);return;
                 if(data.length == 0){
                      $(".table-list").hide();
                     $(".modal-error").show();
                 }else{
                     $(".modal-error").hide();
                     $(".table-list").show();
                     var html = "";
                     for(var i =0;i<=data.length -1;i++){
                         html +="<tr ondblclick='getitem($(this));'><td>"+data[i]['product_code']+"</td><td>"+data[i]['name']+"<input type='hidden' class='recid' value='"+data[i]['id']+"'/></td></tr>"
                       
                     }
                     $(".table-list tbody").html(html);
                     
                 }
              }
            });
  }
JS;
$this->registerJs($js,static::POS_END);
?>
