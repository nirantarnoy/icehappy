<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Saleorder */

$this->title = 'สร้างรายการขาย';
$this->params['breadcrumbs'][] = ['label' => 'Saleorders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_advance', [
        'model' => $model,
    ]) ?>

</div>
