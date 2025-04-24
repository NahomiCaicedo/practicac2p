<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\DetalleVenta $model */

$this->title = $model->iddetalle;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalle Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="detalle-venta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'iddetalle' => $model->iddetalle], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'iddetalle' => $model->iddetalle], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'iddetalle',
            'cantidad',
            'precio_unitario',
            'precio_total',
            'venta_idventa',
            'productos_idproducto',
        ],
    ]) ?>

</div>
