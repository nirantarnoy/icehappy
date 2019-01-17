<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaleorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'รายการขาย';
$this->params['breadcrumbs'][] = $this->title;
$completed = '';
?>
<div class="chk-alert">
    <?php
    $session = Yii::$app->session;
    if($session->getFlash('msg')){
        $completed = "completed";
    }
    ?>
    <div class="tst3"></div>
</div>
<div class="saleorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card">
        <div class="card-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="fa fa-plus-circle"></i> สร้างใบขาย', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sale_no',
            'sale_date',
            [
                'attribute' => 'sale_zone',
                'value' => function($data){
                    return \backend\models\Salezone::findName($data->sale_zone);
                }
            ],
            [
                'attribute'=>'status',
                'contentOptions' => ['style' => 'vertical-align: middle'],
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
                'attribute' => 'created_at',
                'value' => function($data){
                    return date('d-m-Y',$data->created_at);
                }
            ],
            //'updated_at',
            //'created_by',
            //'updated_by',

            //['class' => 'yii\grid\ActionColumn'],
            [

                'header' => '',
                'headerOptions' => ['style' => 'width:200px;text-align:center;','class' => 'activity-view-link',],
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'text-align: center'],
                'template' => '{view}{update}{print}{delete}',
                'buttons' => [
                    'view' => function($url, $data, $index) {
                        $options = [
                            'title' => Yii::t('yii', 'View'),
                            'aria-label' => Yii::t('yii', 'View'),
                            'data-pjax' => '0',
                        ];
                        return Html::a(
                            '<span class="fa fa-eye btn btn-secondary"></span>', $url, $options);
                    },
                    'update' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Update'),
                            'aria-label' => Yii::t('yii', 'Update'),
                            'data-pjax' => '0',
                            'id'=>'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fa fa-edit btn btn-secondary"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'print' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Print'),
                            'aria-label' => Yii::t('yii', 'Print'),
                            'data-pjax' => '0',
                            'id'=>'modaledit',
                        ]);
                        return Html::a(
                            '<span class="fa fa-print btn btn-secondary"></span>', $url, [
                            'id' => 'activity-view-link',
                            //'data-toggle' => 'modal',
                            // 'data-target' => '#modal',
                            'data-id' => $index,
                            'data-pjax' => '0',
                            // 'style'=>['float'=>'rigth'],
                        ]);
                    },
                    'delete' => function($url, $data, $index) {
                        $options = array_merge([
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            //'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                            //'data-method' => 'post',
                            //'data-pjax' => '0',
                            'data-url'=>$url,
                            'onclick'=>'recDelete($(this));'
                        ]);
                        return Html::a('<span class="fa fa-trash btn btn-secondary"></span>', 'javascript:void(0)', $options);
                    }
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
<?php
$js=<<<JS
 $(function() {
     var comp = "$completed";
     if(comp == "completed"){
        // $(".tst3").click(function(){
           $.toast({
            heading: 'แจ้งผลการทำงาน',
            text: 'ระบบทำการลบข้อมูลที่คุณต้องการลบแล้ว',
            position: 'top-right',
            loaderBg:'#ff6849',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });

     //});
     }
   
 });
    function recDelete(e){
            //e.preventDefault();
            var url = e.attr("data-url");
          //  alert(url);
            swal({   
                title: "คุณต้องการลบข้อมูลนี้ใช่หรือไม่?",   
                text: "ข้อมูลนี้จะถูกลบแบบถาวรเลยนะ!",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "ตกลง",   
                cancelButtonText: "เลิกทำ",   
                closeOnConfirm: false 
            }, function(){  
                  e.attr("href",url); 
                  e.trigger("click"); 
                //  swal("ลบข้อมูลเรียบร้อยแล้ว!", "ระบบทำการลบข้อมูลที่คุณต้องการให้แล้ว.", "success"); 
            });
    }
JS;
$this->registerJs($js,static::POS_END);
?>
