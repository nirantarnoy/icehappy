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
  $("#sale-zone").change(function() {
     if($(this).val()!=''){
         $.ajax({
             'type':'post',
             'dataType': 'html',
             'url': "$url_to_find_salezone",
             'data': {'id':$(this).val()},
             'success': function(data) {
                $("#sale-zone-name").val(data);
             }
         });
     }
  });
});
JS;
$this->registerJs($js,static::POS_END);

?>
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
                        <input type="text" class="form-control" name="" id="sale-zone-name" disabled>
                    </div>
                    <div class="col-lg-3">
                        <label for="">เลขที่ใบขาย</label>
                        <input type="text" class="form-control" name="sale_no" disabled>
                    </div>
                    <div class="col-lg-3">
                        <label for="">วันที่</label>
                        <?php $dateval = "".$model->isNewRecord?date('Y-m-d')."":"".date('Y-m-d',$model->trans_date)."";?>
                        <input class="form-control" name="trans_date" type="date" value=<?=$dateval?> id="example-date-input">
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-list">
                    <thead>
                        <tr>
                            <td></td>
                            <td></td>
                            <td colspan="3" style="text-align: center">น้ำแข็งหลอดใหญ่</td>
                            <td colspan="3" style="text-align: center">น้ำแข็งหลอดเล็ก</td>
                            <td colspan="3" style="text-align: center">น้ำแข็งบด</td>
                            <td></td>
                            <td></td>
                            <td></td>
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
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2" style="text-align: right">รวมทั้งหมด</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
