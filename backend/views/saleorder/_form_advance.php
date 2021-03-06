<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 01/12/2018
 * Time: 16:39:38
 */
use yii\helpers\Html;
use yii\helpers\Url;


$this->title = "Create Saleorder";
$sale_zone = \backend\models\Salezone::find()->asArray()->all();

$url_to_find_salezone = Url::to(['saleorder/findzone'],true);

$js=<<<JS
$(function() {
    calall();
  $("#sale-zone").change(function() {
     if($(this).val()!=''){
         $.ajax({
             'type':'post',
             'dataType': 'json',
             'url': "$url_to_find_salezone",
             'data': {'id':$(this).val()},
             'success': function(data) {
                 if(data.length >0){
                     var html = '';
                     var i = 0;
                     $("#sale-zone-name").val(data[0]['zone_name']);
                     if(data[0]['cus_code']!=''){
                         for(i=0;i<=data.length -1;i++){
                             html+="<tr>";
                             html+="<td>"+data[i]['cus_code']+"<input type='hidden' name='cus_id[]' value='"+data[i]['cus_id']+"'></td>";
                             html+="<td style='width:12%'>"+data[i]['cus_name']+"</td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product1-qty-"+i+"' name='product1-qty[]' onchange='caltotal($(this));'/></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product1-price-"+i+"' name='product1-price[]' value='"+data[i]['price1']+"'/></td>";
                             html+="<td style='width:8%'>"+"<input type='text' style='text-align: right' class='form-control' id='product1-total-"+i+"' name='product1-total[]' disabled /></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product2-qty-"+i+"' name='product2-qty[]' onchange='caltotal($(this));'/></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product2-price-"+i+"' name='product2-price[]' value='"+data[i]['price2']+"'/></td>";
                             html+="<td style='width:8%'>"+"<input type='text' style='text-align: right' class='form-control' id='product2-total-"+i+"' name='product2-total[]' disabled /></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product3-qty-"+i+"' name='product3-qty[]' onchange='caltotal($(this));'/></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product3-price-"+i+"' name='product3-price[]' value='"+data[i]['price3']+"'/></td>";
                             html+="<td style='width:8%'>"+"<input type='text' style='text-align: right' class='form-control' id='product3-total-"+i+"' name='product3-total[]' disabled /></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product4-qty-"+i+"' name='product4-qty[]' onchange='caltotal($(this));'/></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='product4-price-"+i+"' name='product4-price[]' value='"+data[i]['price4']+"'/></td>";
                             html+="<td style='width:8%'>"+"<input type='text' style='text-align: right' class='form-control' id='product4-total-"+i+"' name='product4-total[]' disabled /></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='free1-qty-"+i+"' name='free1-qty[]' onchange='calall();'/></td>";
                             html+="<td>"+"<input type='text' style='text-align: right' class='form-control' id='free2-qty-"+i+"'name='free2-qty[]' onchange='calall();'/></td>";
                             html+="<td>"+"</td>";
                             html+="</tr>";
                         }
                     }else{
                         alert("เขตการขายนี้ยังไม่มีรหัสลูกค้า");
                     }
                     
                     $("table.table-list tbody").html(html);
                 }
                
             }
         });
     }
  });
});
function caltotal(e){
    var ids = e.attr("id");
    var x = ids.split('-');
    var closest_price = x[0]+"-"+"price-"+x[2];
    var closest_total = x[0]+"-"+"total-"+x[2];
    var line_price = e.closest("tr").find("#"+closest_price).val();
    e.closest("tr").find("#"+closest_total).val((e.val() * line_price));
    //alert(line_price);
    
    calall();
}
function caltotalprice(e){
    var ids = e.attr("id");
    var x = ids.split('-');
    var closest_qty = x[0]+"-"+"qty-"+x[2];
    var closest_total = x[0]+"-"+"total-"+x[2];
    var line_qty = e.closest("tr").find("#"+closest_qty).val();
    e.closest("tr").find("#"+closest_total).val((e.val() * line_qty));
    //alert(line_price);
    
    calall();
}
function calall() {
  var product1_qty = 0;
  var product2_qty = 0;
  var product3_qty = 0;
  var product4_qty = 0;
  
  var product1_total = 0;
  var product2_total = 0;
  var product3_total = 0;
  var product4_total = 0;
  
  var free1_total = 0;
  var free2_total = 0;
  
  $("table.table-list tbody tr").each(function() {
     product1_qty = (product1_qty + parseInt($(this).find("td:eq(2) input:text").val() ==''?0:$(this).find("td:eq(2) input:text").val()));
     product2_qty = (product2_qty + parseInt($(this).find("td:eq(5) input:text").val() ==''?0:$(this).find("td:eq(5) input:text").val()));
     product3_qty = (product3_qty + parseInt($(this).find("td:eq(8) input:text").val() ==''?0:$(this).find("td:eq(8) input:text").val()));
     product4_qty = (product4_qty + parseInt($(this).find("td:eq(11) input:text").val() ==''?0:$(this).find("td:eq(11) input:text").val()));
     
     product1_total = (product1_total + parseFloat($(this).find("td:eq(4) input:text").val() ==''?0:$(this).find("td:eq(4) input:text").val()));
     product2_total = (product2_total + parseFloat($(this).find("td:eq(7) input:text").val() ==''?0:$(this).find("td:eq(7) input:text").val()));
     product3_total = (product3_total + parseFloat($(this).find("td:eq(10) input:text").val() ==''?0:$(this).find("td:eq(10) input:text").val()));
     product4_total = (product4_total + parseFloat($(this).find("td:eq(13) input:text").val() ==''?0:$(this).find("td:eq(13) input:text").val()));
    
    
     free1_total = (free1_total + parseInt($(this).find("td:eq(14) input:text").val() ==''?0:$(this).find("td:eq(14) input:text").val()));
     free2_total = (free2_total + parseInt($(this).find("td:eq(15) input:text").val() ==''?0:$(this).find("td:eq(15) input:text").val()));
     
     
     
  });
  $("table.table-list tfoot tr").find("td:eq(1)").text(product1_qty);
  $("table.table-list tfoot tr").find("td:eq(4)").text(product2_qty);
  $("table.table-list tfoot tr").find("td:eq(7)").text(product3_qty);
  $("table.table-list tfoot tr").find("td:eq(10)").text(product4_qty);
  
  $("table.table-list tfoot tr").find("td:eq(3)").text(product1_total);
  $("table.table-list tfoot tr").find("td:eq(6)").text(product2_total);
  $("table.table-list tfoot tr").find("td:eq(9)").text(product3_total);
  $("table.table-list tfoot tr").find("td:eq(12)").text(product4_total);
  
  $("table.table-list tfoot tr").find("td:eq(13)").text(free1_total);
  $("table.table-list tfoot tr").find("td:eq(14)").text(free2_total);
  
  
}
JS;
$this->registerJs($js,static::POS_END);
$to_url = $model->isNewRecord?"index.php?r=saleorder/createorder":"index.php?r=saleorder/updateorder";

?>
<form id="sale-form" action="<?=$to_url?>" method="post">
    <input type="hidden" name="sale_id" value="<?=$model->isNewRecord?0:$model->id?>">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3">
                        <label for="">เขตการขาย/เส้นทาง</label>
                        <select name="sale_zone" class="form-control" id="sale-zone">
                            <option value="">-- เลือกเส้นทาง ---</option>
                            <?php for($i=0;$i<=count($sale_zone)-1;$i++):?>
                                <?php
                                $select = '';
                                if($model->sale_zone == $sale_zone[$i]['id']){$select = "selected";}
                                ?>
                                <option value="<?=$sale_zone[$i]['id']?>" <?=$select?>><?=$sale_zone[$i]['name']?></option>
                            <?php endfor;?>

                        </select>
                    </div>
                    <div class="col-lg-3">
                        <label for="">ชื่อเขต/เส้นทาง</label>
                        <input type="text" class="form-control" name="sale_zone_name" id="sale-zone-name" value="<?=$model->isNewRecord?'':$zone_name;?>" disabled>
                    </div>
                    <div class="col-lg-3">
                        <label for="">เลขที่ใบขาย</label>
                        <input type="text" class="form-control" name="sale_no" value="<?=$runno;?>" readonly>
                    </div>
                    <div class="col-lg-3">
                        <label for="">วันที่</label>
                        <?php $dateval = "".$model->isNewRecord?date('Y-m-d')."":"".$model->sale_date."";?>
                        <input class="form-control" name="sale_date" type="date" value=<?=$dateval?> id="example-date-input">
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div style="overflow-x: scroll">
                <table class="table table-bordered table-list" style="overflow: auto;width: 1500px">
                    <thead>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="3" style="text-align: center">น้ำแข็งหลอดใหญ่</td>
                            <td colspan="3" style="text-align: center">น้ำแข็งหลอดเล็ก</td>
                            <td colspan="3" style="text-align: center">น้ำแข็งบด</td>
                            <td colspan="3" style="text-align: center">น้ำแข็งแพ็ค</td>
                            <td colspan="3"></td>
                        </tr>
                        <tr>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">รหัส</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">ชื่อร้านค้า</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">จำนวน</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">ราคา</td>
                            <td rowspan="2" style="vertical-align: middle;text-align: center;">รวมเงิน</td>
                            <td colspan="2" style="text-align: center;">แถม</td>
                            <td></td>
                        </tr>
                        <tr>

                            <td style="text-align: center;">ญ</td>
                            <td style="text-align: center;">ล</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
<!--                        <tr>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                            <td></td>-->
<!--                        </tr>-->
                    <?php if(!$model->isNewRecord):?>
                    <?php //$i=0;
                       // print_r($query);return;
                        ?>
                    <?php for ($i=0;$i<=count($query)-1;$i++):?>
                            <?php //$i+=1;
                              $qty_big = '';
                              $qty_small = '';

                              if(count($modelfree)){
                                  $qty_big = $modelfree[$i]['customer_id']==$query[$i]['customer_id']?$modelfree[$i]['qty_big']:'';
                                  $qty_small = $modelfree[$i]['customer_id']==$query[$i]['customer_id']?$modelfree[$i]['qty_small']:'';
                              }
                            ?>
                    <tr>
                        <td>
                            <?=$query[$i]['code']?>
                            <input type='hidden' name='cus_id[]' value="<?=$query[$i]['customer_id']?>">
                        </td>
                        <td style="width: 15%"><?=$query[$i]['first_name']." ".$query[$i]['last_name']?></td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;'  id='product1-qty-<?=$i?>' value="<?=$query[$i]['qty1']?>" name='product1-qty[]' onchange='caltotal($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product1-price-<?=$i?>' value="<?=number_format($query[$i]['price1'],1)?>" name='product1-price[]' onchange='caltotalprice($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product1-total-<?=$i?>' value="<?=number_format($query[$i]['total1'],1)?>" name='product1-total[]' readonly/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product2-qty-<?=$i?>' value="<?=$query[$i]['qty2']?>" name='product2-qty[]' onchange='caltotal($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product2-price-<?=$i?>' value="<?=number_format($query[$i]['price2'],1)?>" name='product2-price[]' onchange='caltotalprice($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product2-total-<?=$i?>' value="<?=number_format($query[$i]['total2'],1)?>" name='product2-total[]' readonly/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product3-qty-<?=$i?>' value="<?=$query[$i]['qty3']?>" name='product3-qty[]' onchange='caltotal($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product3-price-<?=$i?>' value="<?=number_format($query[$i]['price3'],1)?>" name='product3-price[]' onchange='caltotalprice($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product3-total-<?=$i?>' value="<?=number_format($query[$i]['total3'],1)?>" name='product3-total[]' readonly/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product4-qty-<?=$i?>' value="<?=$query[$i]['qty4']?>" name='product4-qty[]' onchange='caltotal($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product4-price-<?=$i?>' value="<?=number_format($query[$i]['price4'],1)?>" name='product4-price[]' onchange='caltotalprice($(this));'/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='product4-total-<?=$i?>' value="<?=number_format($query[$i]['total4'],1)?>" name='product4-total[]' readonly/>
                        </td>
                        <td>
                            <input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='free1-qty-<?=$i?>' value="<?=$qty_big?>" name='free1-qty[]'/>
                        </td>
                        <td><input type='text' class='form-control' style='text-align: right;padding-left: 1px;padding-right: 1px;' id='free2-qty-<?=$i?>' value="<?=$qty_small?>" name='free2-qty[]'/></td>
                        <td></td>
                    </tr>
                    <?php endfor;?>
                    <?php endif;?>
                    </tbody>
                    <tfoot>
                    <tr style="font-weight: bold">
                        <td colspan="2" style="text-align: right">รวมทั้งหมด</td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center;background-color: #9cc2cb;text-align: right"></td>
                        <td style="text-align: center"></td>
                    </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="บันทึก">
    </div>
</div>
</form>

