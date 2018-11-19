<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Salezone */

$this->title = 'สร้างเขต/เส้นทาง';
$this->params['breadcrumbs'][] = ['label' => 'เขต/เส้นทาง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salezone-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
