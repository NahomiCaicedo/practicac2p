<?php

use app\models\DetalleVenta;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DetalleVentaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Detalle Ventas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="detalle-venta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Detalle Venta'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'iddetalle',
            'cantidad',
            'precio_unitario',
            'precio_total',
            'venta_idventa',
            //'productos_idproducto',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, DetalleVenta $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'iddetalle' => $model->iddetalle]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
