<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Usergroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-group-form">
 <div class="card">
     <div class="card-body">
         <?php $form = ActiveForm::begin(); ?>

         <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

         <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

         <?= $form->field($model, 'status')->textInput() ?>

         <div class="form-group">
             <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
         </div>

         <?php ActiveForm::end(); ?>

     </div>
 </div>

</div>
