<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\DetalleVenta $model */

$this->title = Yii::t('app', 'Update Detalle Venta: {name}', [
    'name' => $model->iddetalle,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Detalle Ventas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->iddetalle, 'url' => ['view', 'iddetalle' => $model->iddetalle]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="detalle-venta-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
