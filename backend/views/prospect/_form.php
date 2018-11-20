<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prospect-form">
    <div class="card">
        <div class="card-body">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'line')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seeme')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_place')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
