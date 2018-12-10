<?php

/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'น้ำแข็งแฮปปี้';
$sale_by_zone = $sale_by_zone;
$zone_date_filter = date('d-m-Y').'-'.date('d-m-Y');
if($sdate !=''){
    $zone_date_filter = $sdate.'-'.$ndate;
}

?>
<input type="hidden" class="sale-by-zone" name="" value="<?=$sale_by_zone?>">
<div class="card-group">

    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="mdi mdi-wallet text-purple"></i></h2>
                    <h3 class=""><?=number_format(count($cust_new),0)?></h3>
                    <h6 class="card-subtitle">ลูกค้าใหม่</h6></div>
                <div class="col-12">

                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="mdi mdi-buffer text-warning"></i></h2>
                    <h3 class="">2</h3>
                    <h6 class="card-subtitle">คัดกรองลูกค้ารออนุมัติ</h6></div>
                <div class="col-12">
                    <div class="progress">
<!--                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="mdi mdi-briefcase-check text-info"></i></h2>
                    <h3 class="">2456</h3>
                    <h6 class="card-subtitle">New Projects</h6></div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 85%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="mdi mdi-alert-circle text-success"></i></h2>
                    <h3 class="">546</h3>
                    <h6 class="card-subtitle">Pending Project</h6></div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 40%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="d-flex no-block">
            <h4 class="card-title">ยอดขายรวมแต่ละเขต<br/><small class="text-muted">Total sales by zone</small></h4>
            <div class="ml-auto">
<!--                    <h5 class="box-title m-t-30">Date Range Pick</h5>-->
                <form id="date_filter_by_zone" action="<?=Url::to(['site/index'],true)?>" method="post">
                    <input class="form-control input-daterange-datepicker" type="text" name="date_filter_zone" value="<?=$zone_date_filter?>" />
                </form>

            </div>
        </div>
    </div>
    <div class="bg-light p-20">
        <div class="d-flex">
            <div class="align-self-center">
                <h3 class="m-b-0">ยอดขายรวมทั้งหมด</h3><small></small></div>
            <div class="ml-auto align-self-center">
                <h2 class="text-success"><?=number_format($total_by_zone,2)?></h2></div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-wrap">
<!--                    <div>-->
<!--                        <h4 class="card-title">Yearly Earning</h4>-->
<!--                    </div>-->
<!--                    <div class="ml-auto">-->
<!--                        <ul class="list-inline">-->
<!--                            <li>-->
<!--                                <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>Sales</h6> </li>-->
<!--                            <li>-->
<!--                                <h6 class="text-muted  text-info"><i class="fa fa-circle font-10 m-r-10"></i>Earning ($)</h6> </li>-->
<!--                        </ul>-->
<!--                    </div>-->
                </div>
            </div>
            <div class="col-12">
                <div id="earnings" style="height: 355px;"></div>
            </div>
        </div>
    </div>
</div>



<?php
$js =<<<JS
$(function() {
   var data= jQuery.parseJSON('$sale_by_zone'); 
//   if(sale_by_zone.length > 0){
       console.log(data);
//   }
//         $.each(data, function(i,item) {
//             alert(data[i].name);
//             alert(data[i].description);
//         });
   
   Morris.Bar({
        element: 'earnings',
        data: data,
        xkey: 'name',
        ykeys: ['sale_amount'],
        labels: ['ยอดขาย'],
        barColors:['#55ce63', '#2f3d4a', '#009efb'],
        hideHover: 'auto',
        gridLineColor: '#eef0f2',
        resize: true
    });
   $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
       
    });
   $('.input-daterange-datepicker').change(function() {
     //  alert();
     $('form#date_filter_by_zone').submit();
   });
});
JS;
$this->registerJs($js,static::POS_END);
?>
