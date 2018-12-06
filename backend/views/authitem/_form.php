<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Authitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authitem-form">
    <div class="card">
        <div class="card-body">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <label for="">ประเภท</label>
    <?php //echo $form->field($model, 'type')->textInput() ?>
            <select name="auth_type" id="" class="form-control auth-type">
                <option value="">-- เลือกประเภท --</option>
                <?php
                $value = \backend\helpers\AuthType::asArrayObject();
                for ($i=0;$i<=count($value)-1;$i++):?>
                   <?php $select = '';
                    if($value[$i]['id']==$model->type){$select = 'selected';}
                    ?>
                    <option value="<?=$value[$i]['id']?>" <?=$select?>><?=$value[$i]['name']?></option>
                <?php endfor;?>
            </select>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'child_list')->textInput(['maxlength' => true]) ?>

    <?php //echo $form->field($model, 'data')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
