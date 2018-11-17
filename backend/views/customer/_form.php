<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Custumer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="custumer-form">
    <div class="card">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'card_id')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'customer_group_id')->textInput() ?>

                    <?= $form->field($model, 'customer_type_id')->textInput() ?>

                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'lat')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'long')->textInput(['maxlength' => true]) ?>

                    <?php //echo $form->field($model, 'status')->textInput() ?>

                    <div class="demo-switch-title">สถานะ</div>
                    <div class="switch">
                        <label>
                            <input type="checkbox" name="status" checked><span class="lever switch-col-light-green"></span></label>
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
