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
                                        <td>Milk Powder</td>
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
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <div class="right-sidebar">
            <div class="slimscrollright">
                <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                <div class="r-panel-body">
                    <ul id="themecolors" class="m-t-20">
                        <li><b>With Light sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default" class="default-theme">1</a></li>
                        <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                        <li><a href="javascript:void(0)" data-theme="red" class="red-theme">3</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue" class="blue-theme working">4</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna" class="megna-theme">6</a></li>
                        <li class="d-block m-t-30"><b>With Dark sidebar</b></li>
                        <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                        <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                        <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">9</a></li>
                        <li><a href="javascript:void(0)" data-theme="blue-dark" class="blue-dark-theme">10</a></li>
                        <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                        <li><a href="javascript:void(0)" data-theme="megna-dark" class="megna-dark-theme ">12</a></li>
                    </ul>
                    <ul class="m-t-20 chatonline">
                        <li><b>Chat option</b></li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/7.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="../assets/images/users/8.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
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
  $("table.table-sale tbody tr").each(function() {
     var line_total = $(this).closest("tr").find(".line-total").text();
     console.log(line_total);
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

