<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Custumer */

$this->title = 'แก้ไขข้อมูลลูกค้า: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'ลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="custumer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelfile' => $modelfile,
        'item_select' => $item,
        'bucket' => $bucket,
        'model_address'=>$model_address,
        'model_address_plant'=>$model_address_plant,
    ]) ?>

</div>
