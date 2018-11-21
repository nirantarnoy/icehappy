<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'คัดกรองลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="prospect-view">


    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Approve', ['approve', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                        'confirm'=>'คุณต้องการอนุมัติลูกค้าใช่หรือไม่',
                        'method' => 'post'
                ]
        ]) ?>
    </p>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <?= DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    // 'id',
                                    'name',
                                    'contact_name',
                                    'mobile',
                                    'phone',
                                    'line',
                                    'facebook',
                                    //'seeme',
                                     [
                                            'attribute'=>'delivery_type',
                                            'value'=>function($data){
                                              return \backend\helpers\DeliveryType::getTypeById($data->delivery_type);
                                            }
                                    ],
                                    'delivery_place',
                                    [
                                            'attribute'=>'status',
                                            'format'=>'raw',
                                            'value'=>function($data){
                                              return "<label class='label label-warning'>".\backend\helpers\ProspectStatus::getTypeById($data->status)."</label>";
                                            }
                                    ]
        //            'created_at',
        //            'updated_at',
        //            'created_by',
        //            'updated_by',
                                ],
                            ]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="card-title">
                              รู้จักเราจาก
                          </div>
                          <?php if(count($modelseeme)>0):?>
                          <?php $x = 0;?>
                          <?php foreach ($modelseeme as $value):?>
                              <input type="checkbox" id="bucket_checkbox_<?=$x?>" class="filled-in chk-col-cyan" checked disabled />
                              <label for="bucket_checkbox_<?=$x?>"><?=\backend\helpers\SeeType::getTypeById($value->itemid)?></label>
                              <?php $x+=1;?>
                              <?php endforeach;?>
                          <?php endif;?>
                      </div>
                  </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                สนใจสินค้า
                            </div>
                            <table class="table table-bordered">
                                <?php if(count($modelitem)>0):?>

                                    <?php foreach ($modelitem as $value):?>
                                       <tr>
                                           <td style="width: 70%"><?=\backend\helpers\item::getTypeById($value->itemid)?></td>
                                           <td style="width: 30%"><?=$value->qty?></td>
                                       </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </table>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                ต้องการยืมถัง
                            </div>
                            <table class="table table-bordered">
                                <?php if(count($modelbucket)>0):?>

                                    <?php foreach ($modelbucket as $value):?>
                                        <tr>
                                            <td style="width: 70%"><?=\backend\helpers\Bucket::getTypeById($value->itemid)?></td>
                                            <td style="width: 30%"><?=$value->qty?></td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                ภาพถ่ายร้าน/บริษัท
                            </div>
                            <?php if(count($modelfile)>0): ?>
                                <?php $list = [];?>
                                <?php foreach ($modelfile as $value):?>
                                    <?php array_push($list,
                                        [
                                            'url' => '../web/uploads/images/'.$value->name,
                                            'src' => '../web/uploads/thumbnail/'.$value->name,
                                            'options' =>[
                                                'title' => 'ทดสอบรูปภาพ',
                                                'style' => ['width'=>20]
                                            ],
                                            'template'=>""
                                        ]
                                    );?>
                                <?php endforeach;?>
                                <?= dosamigos\gallery\Gallery::widget(['items' => $list]);?>
                            <?php endif;?>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                แผนที่
                            </div>
                        </div>
                    </div>
                </div>
    </div>


</div>
