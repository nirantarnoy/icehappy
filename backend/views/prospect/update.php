<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */

$this->title = 'แก้ไขใบคัดกรอง: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => 'คัดกรองลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="prospect-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'item_select' => $item,
        'bucket' => $bucket,
        'seeme' => $seeme,
        'modelfile' => $modelfile,
    ]) ?>

</div>
