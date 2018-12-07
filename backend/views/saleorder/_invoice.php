<?php
/**
 * Created by PhpStorm.
 * User: niran.w
 * Date: 07/12/2018
 * Time: 12:04:59
 */
?>
<div class="page-wrapper" style="margin-top: -120px;">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Invoice</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item">pages</li>
                <li class="breadcrumb-item active">Invoice</li>
            </ol>
        </div>
        <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body printableArea">
                    <h3><b>INVOICE</b> <span class="pull-right"><?=$modelsale->sale_no?></span></h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <h3> &nbsp;<b class="text-danger">Ice Happy Co.,Ltd.</b></h3>
                                    <p class="text-muted m-l-5">บริษัท น้ำแข็งแฮปปี้ จำกัด,
                                        <br/> 52/1 ต.หนองหงษ์,
                                        <br/> อ.ทุ่งสง,
                                        <br/> จ.นครศรีธรรมราช 80110</p>
                                </address>
                            </div>
                            <div class="pull-right text-right">
                                <address>
                                    <h3>ข้อมูลลูกค้า</h3>
                                    <h4 class="font-bold"><?=$customer_name?>,</h4>
                                    <p class="text-muted m-l-30"><?=$customer_address?>
                                        <br/> <?=$customer_street." ".$customer_district?>,
                                        <br/> <?=$customer_city?>,
                                        <br/> <?=$customer_province." ".$customer_zipcode?></p>
                                    <p class="m-t-30"><b>วันที่ :</b> <i class="fa fa-calendar"></i> 23rd Jan 2017</p>
<!--                                    <p><b>Due Date :</b> <i class="fa fa-calendar"></i> 25th Jan 2017</p>-->
                                </address>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover table-sale">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>รายการสินค้า</th>
                                        <th class="text-right">จำนวน</th>
                                        <th class="text-right">ราคาต่อหน่วย</th>
                                        <th class="text-right">รวม</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if($modelsaleline):?>
                                    <?php $i=0;?>
                                    <?php foreach ($modelsaleline as $value):?>
                                    <?php $i+=1;?>
                                    <tr>
                                        <td class="text-center"><?=$i?></td>
                                        <td><?=\backend\models\Product::findName($value->product_id)?></td>
                                        <td class="text-right"><?=number_format($value->qty)?> </td>
                                        <td class="text-right"> <?=number_format($value->price,2)?> </td>
                                        <td class="text-right line-total"> <?=number_format($value->qty * $value->price,2)?> </td>
                                    </tr>
                                    <?php endforeach;?>
                                    <?php endif;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <p>รวม: <span class="total">13,848</span></p>
                                <p>vat (7%) : <span class="vat">138</span> </p>
                                <hr>
                                <h3><b>รวมทั้งสิ้น :</b> <span class="grandtotal">13,986</span></h3>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="text-right">
<!--                                <button class="btn btn-danger" type="submit"> Proceed to payment </button>-->
                                <button id="print" class="btn btn-secondary btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer">
        © 2018 ice happy
    </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<?php
$js=<<<JS
var saletotal = 0;
$(function() {
    $("#print").click(function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
  $("table.table-sale tbody tr").each(function() {
     var line_total = $(this).closest("tr").find(".line-total").text();
    // console.log(line_total);
     saletotal = parseFloat(parseFloat(saletotal) + parseFloat(line_total)).toFixed(2);
  });
  $(".total").text(saletotal);
  var vat = parseFloat((saletotal *7)/100);
  $(".vat").text(parseFloat(vat).toFixed(2));
  $(".grandtotal").text(parseFloat(parseFloat(saletotal) + parseFloat(vat)).toFixed(2));
});
JS;
$this->registerJs($js,static::POS_END);
?>

