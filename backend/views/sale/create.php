<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Sale */

$this->title = 'สร้างรายการขาย';
$this->params['breadcrumbs'][] = ['label' => 'รายการขาย', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
