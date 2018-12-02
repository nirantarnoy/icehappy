<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = 'แก้ไขรายการขาย: ' . $model->sale_no;
$this->params['breadcrumbs'][] = ['label' => 'Saleorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sale_no, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="saleorder-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_advance', [
        'model' => $model,
        'runno' => $runno,
        'zone_name' => $zone_name,
        'modelline' => $modelline,
        'query' => $query,
        'modelfree'=>$modelfree
    ]) ?>

</div>
