<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Salezone */

$this->title = 'แก้ไขเขต/เส้นทาง: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'เขต/เส้นทาง', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salezone-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
