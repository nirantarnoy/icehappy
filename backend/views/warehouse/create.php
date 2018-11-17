<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Warehouse */

$this->title = 'สร้างคลังสินค้า';
$this->params['breadcrumbs'][] = ['label' => 'คลังสินค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wharehouse-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
