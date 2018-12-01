<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\SaleorderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saleorders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="saleorder-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="card">
        <div class="card-body">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Saleorder', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sale_no',
            'sale_date',
            'sale_zone',
            'status',
            //'created_at',
            //'updated_at',
            //'created_by',
            //'updated_by',
            //'approve_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    </div>
</div>
