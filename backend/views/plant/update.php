<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = 'ข้อมูลบริษัท: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Plants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plant-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_address_plant'=>$model_address_plant,
        'model_address'=>$model_address,
    ]) ?>

</div>
