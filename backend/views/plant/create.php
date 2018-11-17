<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Plant */

$this->title = Yii::t('app', 'ข้อมูลบริษัท');
//$this->params['breadcrumbs'][] = ['label' => 'Plants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'model_address'=>$model_address,
        'model_address_plant'=>$model_address_plant,
    ]) ?>

</div>
