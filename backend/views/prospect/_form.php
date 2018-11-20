<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prospect-form">
    <div class="card">
        <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?php //echo $form->field($model, 'delivery_type')->textInput(['maxlength' => true]) ?>
                    <label for="">ประเภทจัดส่ง</label>
                    <select name="delivery_type" class="form-control" id="">
                        <?php
                             $list = \backend\helpers\DeliveryType::asArrayObject();
                             for($i=0;$i<=count($list)-1;$i++):
                           ?>
                                 <option value="<?=$list[$i]['id']?>"><?=$list[$i]['name']?></option>
                        <?php endfor;?>
                    </select>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'delivery_place')->textarea(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3"></div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row">
                <div class="col-lg-6"></div>
                <div class="col-lg-6"></div>
            </div>




            <h4 class="card-title m-t-40">รู้จักเราจาก</h4>
            <div class="demo-checkbox">
                <?php //echo $form->field($model, 'seeme[]')->checkboxList(['niran','tarlek'],['class'=>'filled-in chk-col-pink','checked'=>'checked']) ?>
<!--                <input type="checkbox" id="md_checkbox_21" class="filled-in chk-col-red" checked />-->
                <?php
                $list = \backend\helpers\SeeType::asArrayObject();
                $id = 0;
                for($i=0;$i<=count($list)-1;$i++):?>
                <?php $id+=1;?>
                <input type="checkbox" id="md_checkbox_<?=$id?>" class="filled-in chk-col-cyan" />
                <label for="md_checkbox_<?=$id?>"><?=$list[$i]['name']?></label>
                <?php endfor;?>

            </div>

          <div class="row">
              <div class="col-lg-3">
                  <?= $form->field($model, 'status')->textInput(['readonly'=>'readonly']) ?>
              </div>
          </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">อัพโหลดรูปภาพ</h4>
                            <label for="input-file-max-fs">You can add a max file size</label>
                            <input type="file" id="input-file-max-fs" multiple class="dropify" data-max-file-size="2M" />
                        </div>
                    </div>
                </div>
            </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
