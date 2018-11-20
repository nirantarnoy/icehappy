<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ProspectSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prospect-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'contact_name') ?>

    <?= $form->field($model, 'mobile') ?>

    <?= $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'line') ?>

    <?php // echo $form->field($model, 'facebook') ?>

    <?php // echo $form->field($model, 'seeme') ?>

    <?php // echo $form->field($model, 'delivery_type') ?>

    <?php // echo $form->field($model, 'delivery_place') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
