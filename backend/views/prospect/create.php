<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Prospect */

$this->title = 'สร้างใบคัดกรอง';
$this->params['breadcrumbs'][] = ['label' => 'คัดกรองลูกค้า', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="prospect-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'item_select'=>null,
        'bucket'=>null,
        'seeme'=>null,
    ]) ?>

</div>
