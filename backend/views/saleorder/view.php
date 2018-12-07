<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = $model->sale_no;
$this->params['breadcrumbs'][] = ['label' => 'รายการขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="saleorder-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="card">
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'sale_no',
                'sale_date',
                [
                        'attribute'=>'sale_zone',
                        'value'=> function($data){
                         return \backend\models\Salezone::findFull($data->sale_zone);
                        }
                ],
                [
                    'attribute'=>'status',
                    'format'=>'raw',
                    'value'=>function($data){
                        if($data->status == 1){
                            return '<div class="label label-success">Open</div>';
                        }else if($data->status == 2){
                            '<div class="label label-danger">Completed</div>';
                        }
                    }
                ],
                [
                        'attribute'=>'created_at',
                        'value'=>function($data){
                            return date('d/m/Y',$data->created_at);
                        }
                ],
                [
                    'attribute'=>'updated_at',
                    'value'=>function($data){
                        return date('d/m/Y',$data->created_at);
                    }
                ],
//                'created_by',
//                'updated_by',
//                'approve_by',
            ],
        ]) ?>
    </div>
</div>
    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>รหัส</th>
                        <th>ชื่อลูกค้า</th>
                        <th>ยอดขายรวม</th>
                        <th>พิมพ์ใบเสร็จ</th>
                    </tr>
                </thead>
                <tbody>
                  <?php for($i=0;$i<=count($query)-1;$i++):?>
                    <tr>
                        <td>
                            <input type="hidden" name="" class="sale-id" value="<?=$query[$i]['sale_id']?>">
                            <input type="hidden" name="" class="cust-id" value="<?=$query[$i]['customer_id']?>">
                            <?=$i+1;?>
                        </td>
                        <td>
                            <?=$query[$i]['code']?>
                        </td>
                        <td><?=$query[$i]['first_name']?></td>
                        <td><?=number_format($query[$i]['total_sale'],2)?></td>
                        <td>
                            <div class="btn btn-secondary btn-gen-invoice" onclick="geninvoice($(this))"><i class="fa fa-print"></i> พิมพ์</div>
                        </td>
                    </tr>
                  <?php endfor;?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<?php
$url_to_geninvoice = 'index.php?r=saleorder/printinvoice';
$js=<<<JS
$(function() {
  
});
function geninvoice(e) {
    var saleid = e.closest("tr").find(".sale-id").val();
    var custid = e.closest("tr").find(".cust-id").val();
    
    if(saleid !=''){
        alert(saleid);
        $.ajax({
           'type':'post',
           'dataType':'html',
           'utl': '$url_to_geninvoice',
           'data': {'custid':custid,'saleid':saleid},
           'success': function(data){
               
           }
           
        });
    }
}
JS;
$this->registerJs($js,static::POS_END);
?>
