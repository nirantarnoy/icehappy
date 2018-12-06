<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Authitem */

$this->title = 'สร้างสิทธิ์ใช้งาน';
$this->params['breadcrumbs'][] = ['label' => 'สิทธิ์ใช้งาน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
