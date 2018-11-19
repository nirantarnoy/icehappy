<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use toxor88\switchery\Switchery;
/* @var $this yii\web\View */
/* @var $model backend\models\Custumer */
/* @var $form yii\widgets\ActiveForm */
$custgroup = \backend\models\Custumergroup::find()->all();
$zone = \backend\models\Salezone::find()->all();

?>

<div class="custumer-form">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-4">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'card_id')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'customer_type_id')->textInput() ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'status')->textInput() ?>

                    <?php echo $form->field($model, 'status')->widget(Switchery::className(),['options'=>['label'=>'','class'=>'form-control']])->label(false) ?>

                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    <label>กลุ่มลูกค้า</label>
                    <select name="customer_group" class="form-control" id="">

                        <?php foreach ($custgroup as $value):?>
                            <?php
                            $select = '';
                            if($model->customer_group_id == $value->id){$select = "selected";}
                            ?>
                            <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                    <label>เขต/เส้นทาง</label>
                    <select name="zone_id" class="form-control" id="">

                        <?php foreach ($zone as $value):?>
                            <?php
                            $select = '';
                            if($model->zone_id == $value->id){$select = "selected";}
                            ?>
                            <option value="<?=$value->id?>" <?=$select?>><?=$value->name?></option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>


            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
