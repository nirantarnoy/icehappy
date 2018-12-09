<?php

/* @var $this yii\web\View */

$this->title = 'น้ำแข็งแฮปปี้';
$sale_by_zone = $sale_by_zone;
?>
<input type="hidden" class="sale-by-zone" name="" value="<?=$sale_by_zone?>">
<div class="card">
    <div class="card-body">
        <div class="d-flex no-block">
            <h4 class="card-title">ยอดขายรวมแต่ละเขต<br/><small class="text-muted">Total sales by zone</small></h4>
            <div class="ml-auto">
<!--                    <h5 class="box-title m-t-30">Date Range Pick</h5>-->
                    <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2015 - 01/31/2015" />
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
<div class="card-group">
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
    <!-- Column -->
    <!-- Column -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h2 class="m-b-0"><i class="mdi mdi-wallet text-purple"></i></h2>
                    <h3 class="">$24561</h3>
                    <h6 class="card-subtitle">Total Cost</h6></div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 56%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                    <h2 class="m-b-0"><i class="mdi mdi-buffer text-warning"></i></h2>
                    <h3 class="">$30010</h3>
                    <h6 class="card-subtitle">Total Earnings</h6></div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Column -->

    <!-- Column -->
    <div class="col-lg-4 col-xlg-3">
        <div class="card card-inverse card-info">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <h1 class="text-white"><i class="ti-light-bulb"></i></h1></div>
                    <div>
                        <h3 class="card-title">Sales Analytics</h3>
                        <h6 class="card-subtitle">March  2017</h6> </div>
                </div>
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h2 class="font-light text-white"><sup><small><i class="ti-arrow-up"></i></small></sup>35487</h2>
                    </div>
                    <div class="col-6 p-t-10 p-b-20 text-right">
                        <div class="spark-count" style="height:65px"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-inverse card-success">
            <div class="card-body">
                <div class="d-flex">
                    <div class="m-r-20 align-self-center">
                        <h1 class="text-white"><i class="ti-pie-chart"></i></h1></div>
                    <div>
                        <h3 class="card-title">Bandwidth usage</h3>
                        <h6 class="card-subtitle">March  2017</h6> </div>
                </div>
                <div class="row">
                    <div class="col-6 align-self-center">
                        <h2 class="font-light text-white">50 GB</h2>
                    </div>
                    <div class="col-6 p-t-10 p-b-20 text-right align-self-center">
                        <div class="spark-count2" style="height:65px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
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
        cancelClass: 'btn-inverse'
    });
});
JS;
$this->registerJs($js,static::POS_END);
?>
